<template>
  <Palakasan>
    <div class="grid grid-cols-6">
      <div class="col-span-4 border border-gray-300 shadow p-4 rounded-lg">
        <div class="flex justify-between">
          <div>
            <h1 class="text-2xl font-bold text-gray-800">Palakasan {{ latestPalakasan?.year }}</h1>
            <p v-if="latestPalakasan" class="text-sm text-gray-700">
              {{ latestPalakasan.start_date }} - {{ latestPalakasan.end_date }}
            </p>
          </div>
          <div class="space-x-2.5 flex">
            <div>
              <div class="flex rounded-lg">
                <button 
                  @click="toggleStatus(latestPalakasan)" 
                  class="bg-red-600 text-white py-1.5 px-2.5 text-sm rounded-s-lg hover:bg-red-600/90 transition-colors">
                  <i class="fa-solid fa-right-left"></i>
                </button>
                <p :class="latestPalakasan && latestPalakasan.status ? 'text-sm py-2.5 px-2 bg-green-50 rounded-e-lg text-green-700' : 'text-sm py-1.5 px-2 bg-red-100 rounded-e-lg text-red-700'">
                  {{ latestPalakasan ? (latestPalakasan.status ? 'Activated' : 'Deactivated') : '' }}
                </p>
              </div>
            </div>
            <div class="space-x-2.5">
              <button class="bg-white text-gray-800 py-1.5 px-2.5 text-sm rounded-md ring-1 ring-gray-300 shadow hover:bg-gray-100 transition-colors">
                <i class="fa-solid fa-book mr-1.5"></i> History
              </button>
              <button 
                @click="openModal" 
                class="text-white py-1.5 px-2.5 text-sm rounded-md bg-blue-700 shadow hover:bg-blue-700/90 transition-colors">
                <i class="fa-solid fa-file mr-1.5"></i> New
              </button>
            </div>
          </div>
        </div>

        <div v-if="latestPalakasan" class="mt-3">
          <p class="text-md font-semibold text-gray-800">{{ latestPalakasan.theme }}</p>
          <p class="text-sm text-gray-700">{{ latestPalakasan.tagline }}</p>

          <p class="text-sm text-gray-700 mt-2">{{ latestPalakasan.description }}</p>
        </div>

        <div class="grid grid-cols-4 mt-4 gap-4">
          <div class="p-4 bg-blue-50 hover:bg-blue-100 cursor-pointer rounded-lg">
            <div>
              <h1 class="text-md font-semibold text-blue-700">Sports</h1>
            </div>
            <p class="mt-4 text-center text-3xl font-semibold text-blue-700 mb-3">0</p>
            <p class="text-xs text-blue-700 text-center mb-3">total number of sports</p>
          </div>
          <div class="p-4 bg-blue-50 hover:bg-blue-100 cursor-pointer rounded-lg">
            <div>
              <h1 class="text-md font-semibold text-blue-700">Teams</h1>
            </div>
            <p class="mt-4 text-center text-3xl font-semibold text-blue-700 mb-3">{{ teamsInLatestPalakasan.length }}</p>
            <p class="text-xs text-blue-700 text-center mb-3">total number of teams</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for Creating New Palakasan -->
    <transition name="modal">
      <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
          <h2 class="text-lg font-semibold text-gray-800 mb-4">Create New Palakasan</h2>

          <form @submit.prevent="submitPalakasan">
            <!-- Theme -->
            <div class="mb-4">
              <label for="theme" class="block text-sm font-medium text-gray-700">Theme</label>
              <input placeholder="Enter theme of the palakasan..." v-model="form.theme" id="theme" type="text" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required />
              <span v-if="form.errors.theme" class="text-red-600 text-sm">{{ form.errors.theme }}</span>
            </div>

            <!-- Tagline -->
            <div class="mb-4">
              <label for="tagline" class="block text-sm font-medium text-gray-700">Tagline</label>
              <input placeholder="Enter tagline for the palakasan..." v-model="form.tagline" id="tagline" type="text" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required />
              <span v-if="form.errors.tagline" class="text-red-600 text-sm">{{ form.errors.tagline }}</span>
            </div>

            <!-- Description -->
            <div class="mb-4">
              <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
              <textarea placeholder="Explain the palakasan briefly and the theme..." v-model="form.description" rows="6" id="description" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required></textarea>
              <span v-if="form.errors.description" class="text-red-600 text-sm">{{ form.errors.description }}</span>
            </div>

            <div class="grid grid-cols-2 gap-3">
              <!-- Start Date -->
              <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input v-model="form.start_date" id="start_date" type="date" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required />
                <span v-if="form.errors.start_date" class="text-red-600 text-sm">{{ form.errors.start_date }}</span>
              </div>

              <!-- End Date -->
              <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                <input v-model="form.end_date" id="end_date" type="date" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required />
                <span v-if="form.errors.end_date" class="text-red-600 text-sm">{{ form.errors.end_date }}</span>
              </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-2">
              <button @click="closeModal" type="button" class="bg-gray-100 text-gray-700 py-1.5 px-3 rounded-md hover:bg-gray-200">Cancel</button>
              <button type="submit" class="bg-blue-700 text-white py-1.5 px-3 rounded-md hover:bg-blue-800" :disabled="form.processing">Create</button>
            </div>
          </form>
        </div>
      </div>
    </transition>
  </Palakasan>
</template>


<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Palakasan from '@/Layout/PalakasanLayout.vue';

const props = defineProps({
        palakasans: Array,
        assignedTeams:Array,
        latestPalakasan:Array,
        errors: Object
    })

const isModalOpen = ref(false);

const latestPalakasan = computed(() => {
  return props.palakasans.length > 0 ? props.palakasans[props.palakasans.length - 1] : null;
});

// Computed property to filter teams by latest Palakasan event
const teamsInLatestPalakasan = computed(() => {
  return props.assignedTeams.filter(team => team.palakasan_id === props.latestPalakasan.id);
});


// Initialize useForm with default values
const form = useForm({
  theme: '',
  tagline: '',
  description: '',
  start_date: '',
  end_date: '',
  status: false, // Deactivated by default
});

// Function to open the modal
const openModal = () => {
  isModalOpen.value = true;
};

// Function to close the modal
const closeModal = () => {
  isModalOpen.value = false;
  form.reset(); // Reset form when modal is closed
};

// Form submission using useForm's post method
const submitPalakasan = () => {
  form.post('/palakasan/details', {
    onSuccess: () => {
      closeModal(); // Close modal upon successful submission
    },
    onError: () => {
      console.error('Form submission error'); // Handle errors
    },
  });
};

//

const toggleStatus = (palakasan) => {
  // Prepare the updated status (toggle between true and false)
  const updatedStatus = !palakasan.status;

  // Send the update to the server
  form.put(`/palakasan/${palakasan.id}/toggle-status`, {
    preserveScroll: true,  // Optional, prevents scroll to top after submission
    data: { status: updatedStatus },
    onSuccess: () => {
      // Update the local status after the server response
      palakasan.status = updatedStatus;
    },
    onError: () => {
      console.error('Error updating the status');
    },
  });
};
</script>

<style scoped>
.modal {
  transition: opacity 0.5s ease-in-out;
}
</style>
