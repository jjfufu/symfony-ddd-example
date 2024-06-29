import {Controller} from "@hotwired/stimulus";
import {transition} from "../utils/transition.js";

export default class extends Controller {
  static targets = ['menu'];
  static values = {
    open: Boolean
  }

  connect() {
    this.boundBeforeCache = this.beforeCache.bind(this)
    document.addEventListener('turbo:before-cache', this.boundBeforeCache)
  }

  disconnect() {
    document.removeEventListener('turbo:before-cache', this.boundBeforeCache)
  }

  // Ensures the menu is hidden before Turbo caches the page
  beforeCache() {
    this.openValue = false
    this.menuTarget.classList.add("hidden")
  }

  hide() {
    if(this.openValue) this.openValue = false
  }

  toggle() {
    this.openValue = !this.openValue
  }

  openValueChanged() {
    transition(this.menuTarget, this.openValue)
  }
}
