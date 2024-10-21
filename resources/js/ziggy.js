const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"product.index":{"uri":"product","methods":["GET","HEAD"]},"product.create":{"uri":"product\/create","methods":["GET","HEAD"]},"product.store":{"uri":"product","methods":["POST"]},"product.show":{"uri":"product\/{product}","methods":["GET","HEAD"],"parameters":["product"]},"product.edit":{"uri":"product\/{product}\/edit","methods":["GET","HEAD"],"parameters":["product"]},"product.update":{"uri":"product\/{product}","methods":["PUT","PATCH"],"parameters":["product"]},"product.destroy":{"uri":"product\/{product}","methods":["DELETE"],"parameters":["product"],"bindings":{"product":"id"}},"college.index":{"uri":"college","methods":["GET","HEAD"]},"college.create":{"uri":"college\/create","methods":["GET","HEAD"]},"college.store":{"uri":"college","methods":["POST"]},"college.show":{"uri":"college\/{college}","methods":["GET","HEAD"],"parameters":["college"]},"college.edit":{"uri":"college\/{college}\/edit","methods":["GET","HEAD"],"parameters":["college"]},"college.update":{"uri":"college\/{college}","methods":["PUT","PATCH"],"parameters":["college"]},"college.destroy":{"uri":"college\/{college}","methods":["DELETE"],"parameters":["college"],"bindings":{"college":"id"}},"venue.index":{"uri":"venue","methods":["GET","HEAD"]},"venue.create":{"uri":"venue\/create","methods":["GET","HEAD"]},"venue.store":{"uri":"venue","methods":["POST"]},"venue.show":{"uri":"venue\/{venue}","methods":["GET","HEAD"],"parameters":["venue"]},"venue.edit":{"uri":"venue\/{venue}\/edit","methods":["GET","HEAD"],"parameters":["venue"]},"venue.update":{"uri":"venue\/{venue}","methods":["PUT","PATCH"],"parameters":["venue"]},"venue.destroy":{"uri":"venue\/{venue}","methods":["DELETE"],"parameters":["venue"],"bindings":{"venue":"id"}},"sport.index":{"uri":"sport","methods":["GET","HEAD"]},"sport.create":{"uri":"sport\/create","methods":["GET","HEAD"]},"sport.store":{"uri":"sport","methods":["POST"]},"sport.show":{"uri":"sport\/{sport}","methods":["GET","HEAD"],"parameters":["sport"]},"sport.edit":{"uri":"sport\/{sport}\/edit","methods":["GET","HEAD"],"parameters":["sport"]},"sport.update":{"uri":"sport\/{sport}","methods":["PUT","PATCH"],"parameters":["sport"]},"sport.destroy":{"uri":"sport\/{sport}","methods":["DELETE"],"parameters":["sport"],"bindings":{"sport":"id"}},"points.index":{"uri":"points","methods":["GET","HEAD"]},"points.create":{"uri":"points\/create","methods":["GET","HEAD"]},"points.store":{"uri":"points","methods":["POST"]},"points.show":{"uri":"points\/{point}","methods":["GET","HEAD"],"parameters":["point"]},"points.edit":{"uri":"points\/{point}\/edit","methods":["GET","HEAD"],"parameters":["point"]},"points.update":{"uri":"points\/{point}","methods":["PUT","PATCH"],"parameters":["point"]},"points.destroy":{"uri":"points\/{point}","methods":["DELETE"],"parameters":["point"]},"details.index":{"uri":"palakasan\/details","methods":["GET","HEAD"]},"details.create":{"uri":"palakasan\/details\/create","methods":["GET","HEAD"]},"palakasan.store":{"uri":"palakasan\/details","methods":["POST"]},"details.show":{"uri":"palakasan\/details\/{detail}","methods":["GET","HEAD"],"parameters":["detail"]},"details.edit":{"uri":"palakasan\/details\/{detail}\/edit","methods":["GET","HEAD"],"parameters":["detail"]},"details.update":{"uri":"palakasan\/details\/{detail}","methods":["PUT","PATCH"],"parameters":["detail"]},"details.destroy":{"uri":"palakasan\/details\/{detail}","methods":["DELETE"],"parameters":["detail"]},"team.index":{"uri":"palakasan\/team","methods":["GET","HEAD"]},"team.create":{"uri":"palakasan\/team\/create","methods":["GET","HEAD"]},"team.store":{"uri":"palakasan\/team","methods":["POST"]},"team.show":{"uri":"palakasan\/team\/{team}","methods":["GET","HEAD"],"parameters":["team"]},"team.edit":{"uri":"palakasan\/team\/{team}\/edit","methods":["GET","HEAD"],"parameters":["team"]},"team.update":{"uri":"palakasan\/team\/{team}","methods":["PUT","PATCH"],"parameters":["team"]},"team.destroy":{"uri":"palakasan\/team\/{team}","methods":["DELETE"],"parameters":["team"]},"sportselection.index":{"uri":"palakasan\/sportselection","methods":["GET","HEAD"]},"sportselection.create":{"uri":"palakasan\/sportselection\/create","methods":["GET","HEAD"]},"sportselection.store":{"uri":"palakasan\/sportselection","methods":["POST"]},"sportselection.show":{"uri":"palakasan\/sportselection\/{sportselection}","methods":["GET","HEAD"],"parameters":["sportselection"]},"sportselection.edit":{"uri":"palakasan\/sportselection\/{sportselection}\/edit","methods":["GET","HEAD"],"parameters":["sportselection"]},"sportselection.update":{"uri":"palakasan\/sportselection\/{sportselection}","methods":["PUT","PATCH"],"parameters":["sportselection"]},"sportselection.destroy":{"uri":"palakasan\/sportselection\/{sportselection}","methods":["DELETE"],"parameters":["sportselection"]},"student.index":{"uri":"student","methods":["GET","HEAD"]},"student.create":{"uri":"student\/create","methods":["GET","HEAD"]},"student.store":{"uri":"student","methods":["POST"]},"student.show":{"uri":"student\/{student}","methods":["GET","HEAD"],"parameters":["student"]},"student.edit":{"uri":"student\/{student}\/edit","methods":["GET","HEAD"],"parameters":["student"]},"student.update":{"uri":"student\/{student}","methods":["PUT","PATCH"],"parameters":["student"]},"student.destroy":{"uri":"student\/{student}","methods":["DELETE"],"parameters":["student"]},"student.import":{"uri":"student\/import","methods":["POST"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };