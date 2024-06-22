export default class ConfirmLeave {
    constructor() {
        this.init();
    }
    
    init() {
        this.addEventListeners();
    }
    
    addEventListeners() {
        // Add event listener to the form
        document.querySelectorAll('form').forEach((element) => {
        element.addEventListener('submit', this.confirmLeave);
        });
    }
    
    confirmLeave(event) {
        if (!confirm('Are you sure you want to leave this page?')) {
        event.preventDefault();
        }
    }
}