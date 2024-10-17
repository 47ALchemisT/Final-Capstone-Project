<template>
  <Palakasan>
    <!-- Search bar and button to add new teams -->
    <div class="mb-4 flex justify-between items-center">
      <!-- Search Input -->
      <div class="relative">
        <!-- Search Icon (Left) -->
        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
          <i class="fas fa-search"></i>
        </span>

        <!-- Input Field -->
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Search college..."
          class="w-64 pl-10 pr-10 py-2 bg-white shadow-sm border border-gray-300 focus:border-blue-500 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
        />

        <!-- Clear Button (Right) -->
        <button
          v-if="searchQuery"
          @click="clearSearch"
          class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
        >
          <i class="fas fa-times"></i>
        </button>
      </div>

      <!-- Button to open the modal for adding new team -->
      <button @click="openTeamsModal" class="bg-blue-700 text-sm text-white px-4 py-2 rounded-lg">
        Add New Team
      </button>
    </div>

    <!-- Team Cards -->
    <div v-if="filteredTeams.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-5">
      <div
        v-for="team in filteredTeams"
        :key="team.id"
        class="bg-white rounded-lg border border-gray-300 shadow overflow-hidden transition-shadow duration-300 hover:shadow-md"
      >
        <div class="p-4">
          <div class="flex justify-between items-center mb-2">
            <h3 class="text-lg font-semibold text-gray-800 truncate">{{ team.assigned_team_name }}</h3>
            <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
              {{ team.college.shortName }}
            </span>
          </div>
          <p class="text-sm text-gray-600">{{ formatDate(team.created_at) }}</p>
        </div>
      </div>
    </div>

    <!-- No teams found message -->
    <p v-else class="text-gray-600 text-center mt-8">No teams found.</p>

    <!-- Modal for adding new team -->
    <div v-if="isTeamsModalOpen" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
      <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h3 class="text-lg font-semibold mb-4">Add New Team</h3>

        <form @submit.prevent="submitTeam">
          <!-- Select College -->
          <div class="mb-4">
            <label for="college" class="block text-sm font-medium">Select College</label>
            <select v-model="form.college_id" id="college" class="w-full border px-3 py-2 rounded-lg">
              <option value="" disabled>Select a college</option>
              <option
                v-for="college in availableColleges"
                :key="college.id"
                :value="college.id"
              >
                {{ college.shortName }}
              </option>
            </select>
            <span v-if="form.errors.college_id" class="text-red-500">{{ form.errors.college_id }}</span>
          </div>

          <!-- Input for Team Name -->
          <div class="mb-4">
            <label for="teamName" class="block text-sm font-medium">Team Name</label>
            <input
              v-model="form.assigned_team_name"
              id="teamName"
              type="text"
              placeholder="Enter the team name..."
              class="w-full border px-3 py-2 rounded-lg"
            />
            <span v-if="form.errors.assigned_team_name" class="text-red-500">{{ form.errors.assigned_team_name }}</span>
          </div>

          <!-- Hidden Palakasan ID input -->
          <input type="text" v-model="form.palakasan_id" />

          <!-- Modal Buttons -->
          <div class="flex justify-end">
            <button type="button" @click="closeTeamsModal" class="mr-2 px-4 py-2 border rounded-lg">Cancel</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Team</button>
          </div>
        </form>
      </div>
    </div>
  </Palakasan>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Palakasan from '@/Layout/PalakasanLayout.vue';

// Define props
const props = defineProps({
  colleges: Array,
  assignedTeams: Array,
  latestPalakasan: Object, // Add the latest Palakasan to props
  errors: Object,
});

// Reactive variables
const searchQuery = ref('');
const isTeamsModalOpen = ref(false);

// Initialize the form with useForm, including palakasan_id
const form = useForm({
  assigned_team_name: '',
  college_id: '',
  palakasan_id: props.latestPalakasan.id, // Automatically set the latest Palakasan ID
});

// Open Teams modal
const openTeamsModal = () => {
  isTeamsModalOpen.value = true;
};

// Close Teams modal and reset form
const closeTeamsModal = () => {
  isTeamsModalOpen.value = false;
  form.reset(); // Reset the form state
};

// Submit form for adding a new team
const submitTeam = () => {
  form.post('/palakasan/team', {
    onSuccess: () => {
      closeTeamsModal(); // Close modal upon successful submission
    },
    onError: () => {
      console.error('Form submission error'); // Handle errors
    },
  });
};

// Filter teams based on the search query and palakasan_id
const filteredTeams = computed(() => {
  return props.assignedTeams.filter(team =>
    team.palakasan_id === props.latestPalakasan.id && // Filter by latest Palakasan event
    (
      team.assigned_team_name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      team.college.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      team.college.shortName.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
  );
});

// Computed property to get available colleges that haven't been assigned a team yet
const availableColleges = computed(() => {
  const assignedCollegeIds = props.assignedTeams
    .filter(team => team.palakasan_id === props.latestPalakasan.id)
    .map(team => team.college_id);

  return props.colleges.filter(college => !assignedCollegeIds.includes(college.id));
});

// Format date
const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
  });
};

// Clear search query
const clearSearch = () => {
  searchQuery.value = '';
};
</script>

<style scoped>
/* Add any additional styles here if needed */
</style>
