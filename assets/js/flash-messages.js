export default class FlashMessages {
  constructor() {
    this.init();
  }

  init() {
    this.addEventListeners();
  }

  addEventListeners() {
    // Add event listener to the close button of the flash message
    document.querySelectorAll('.flash-message .close').forEach((element) => {
      element.addEventListener('click', this.closeFlashMessage);
    });
  }

  closeFlashMessage(event) {
    event.currentTarget.closest('.flash-message').remove();
  }
}