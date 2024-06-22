export default class Navbar {
  constructor() {
    this.init();
  }

  init() {
    this.addEventListeners();
  }

  addEventListeners() {
    // Add event listener to the navbar toggle button
    document.getElementById('navbar-toggle').addEventListener('click', this.toggleNavbar);
  }

  toggleNavbar() {
    const navbar = document.getElementById('navbar');
    navbar.classList.toggle('hidden');
  }


  hideNavbar() {
    const navbar = document.getElementById('navbar');
    navbar.classList.add('hidden');
  }

  showNavbar() {
    const navbar = document.getElementById('navbar');
    navbar.classList.remove('hidden');
  }

}

