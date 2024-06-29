// Enter transition:
//
//   transition(this.element, true)
//
// Leave transition:
//
//    transition(this.element, false)

/**
 * Valid data set attributes:
 * - data-transition-enter
 * - data-transition-enter-from
 * - data-transition-enter-to
 * - data-transition-leave
 * - data-transition-leave-from
 * - data-transition-leave-to
 */

/**
 * Transition an element in or out
 * @param element
 * @param state
 * @param withToggleClass
 * @returns {Promise<void>}
 */
export async function transition(element, state, withToggleClass = true) {
  if (!!state) {
    enter(element, withToggleClass)
  } else {
    leave(element, withToggleClass)
  }
}

/**
 * Enter transition
 * @param element
 * @param withToggleClass
 * @returns {Promise<void>}
 */
export async function enter(element, withToggleClass = true) {
  const transitionClasses = element.dataset.transitionEnter || "enter"
  const fromClasses = element.dataset.transitionEnterFrom || "enter-from"
  const toClasses = element.dataset.transitionEnterTo || "enter-to"
  const toggleClass = element.dataset.toggleClass || "hidden"

  // Prepare transition
  element.classList.add(...transitionClasses.split(" "))
  element.classList.add(...fromClasses.split(" "))
  element.classList.remove(...toClasses.split(" "))
  if (withToggleClass) {
    element.classList.remove(...toggleClass.split(" "))
  }

  await nextFrame()

  element.classList.remove(...fromClasses.split(" "))
  element.classList.add(...toClasses.split(" "))

  try {
    await afterTransition(element)
  } finally {
    element.classList.remove(...transitionClasses.split(" "))
  }
}

/**
 * Leave transition
 * @param element
 * @param withToggleClass
 * @returns {Promise<void>}
 */
export async function leave(element, withToggleClass = true) {
  const transitionClasses = element.dataset.transitionLeave || "leave"
  const fromClasses = element.dataset.transitionLeaveFrom || "leave-from"
  const toClasses = element.dataset.transitionLeaveTo || "leave-to"
  const toggleClass = element.dataset.toggleClass || "hidden"

  // Prepare transition
  element.classList.add(...transitionClasses.split(" "))
  element.classList.add(...fromClasses.split(" "))
  element.classList.remove(...toClasses.split(" "))

  await nextFrame()

  element.classList.remove(...fromClasses.split(" "))
  element.classList.add(...toClasses.split(" "))

  try {
    await afterTransition(element)
  } catch (e) {
    console.warn(e)
  } finally {
    element.classList.remove(...transitionClasses.split(" "))
    if (withToggleClass) {
      element.classList.add(...toggleClass.split(" "))
    }
  }
}

/**
 * Next frame
 * @returns {Promise<unknown>}
 */
function nextFrame() {
  return new Promise(resolve => requestAnimationFrame(resolve))
}

/**
 * After transition
 * @param element
 * @returns {Promise<Awaited<Animation>[]>}
 */
function afterTransition(element) {
  return Promise.all(element.getAnimations().map(animation => animation.finished))
}
