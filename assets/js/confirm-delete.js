export default class ConfirmDelete {
    constructor() {
        this.init();
    }
    
    init() {
        this.addEventListeners();
    }
    
    addEventListeners() {
        // Add event listener to the delete button
        document.querySelectorAll('.confirm-delete').forEach((element) => {
        element.addEventListener('click', this.confirmDelete);
        });
    }
    
    confirmDelete(event) {
        if (!confirm('Are you sure you want to delete this?')) {
        event.preventDefault();
        }
    }
}


