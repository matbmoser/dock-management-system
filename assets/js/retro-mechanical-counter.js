const element = document.querySelector(".contador");

const ROOT_CLASS_NAME = "digit-flipper";

class DigitFlipper {
  constructor(element, options = {
    number: 9,
    iterationCount: 9 })
  {

    // First, some parameter sanitizing:
    if (options.number > 9 || options.number < 0) return;

    this.options = Object.assign({}, options);

    if (!this.options.number) this.options.number = 9;
    if (!this.options.iterationCount) this.options.iterationCount = 9;

    // Adjusting the number of iterations,
    // in case our numbers end up in the negatives:
    if (this.options.number - this.options.iterationCount < 0) {
      this.options.iterationCount = this.options.number;
    }

    this.element = element;
    this.digitClassName = `${ROOT_CLASS_NAME}__digit`;
    this.topClassName = `${this.digitClassName}-top`;
    this.bottomClassName = `${this.digitClassName}-bottom`;
    this.flipTopClass = `${this.digitClassName}--flip-top`;
    this.flipBottomClass = `${this.digitClassName}--flip-bottom`;
    this.flipDoneClass = `${this.digitClassName}--flip-done`;
    this.DOMNodes = [];
    this.flipDuration = parseFloat(
    (window.getComputedStyle(document.documentElement).
    getPropertyValue("--flip-duration") || "1s").
    replace("s", ""));

    this._init();

    return this;
  }

  _init() {
    this._populateDOM();
  }

  // creates DOM elements for each digit and all of its "iterations"
  _populateDOM() {
    let i = this.options.number - this.options.iterationCount;
    for (i; i <= this.options.number; i++) {
      const digit = document.createElement("span"),
      digitTop = document.createElement("span"),
      digitBottom = document.createElement("span"),
      digitText = document.createTextNode(i);

      digit.className = this.digitClassName;
      digitTop.className = this.topClassName;
      digitBottom.className = this.bottomClassName;

      digitTop.appendChild(digitText);
      digitBottom.appendChild(digitText.cloneNode());
      digit.appendChild(digitTop);
      digit.appendChild(digitBottom);

      this.DOMNodes.push(digit);
      this.element.insertAdjacentElement("afterbegin", digit);
    }
  }

  // runs the animtion sequence for the digit
  flip() {
    this.DOMNodes.forEach((node, index) => {
      const nextNode = this.DOMNodes[index + 1];
      let delay = this.flipDuration * index * 1000;

      // The flipBottomClass turns the bottom half
      // down from it's inital state of 90deg

      // The flipTopClass turns the top half
      // down from it's inital state of 0deg

      const t1 = setTimeout(() => {
        node.classList.add(this.flipBottomClass);
        clearTimeout(t1);
        const t2 = setTimeout(() => {
          if (nextNode) node.classList.add(this.flipTopClass);
          clearTimeout(t2);
          const t3 = setTimeout(() => {
            node.style.zIndex = index + 1;
            clearTimeout(t3);
          }, this.flipDuration);
        }, this.flipDuration);
      }, delay);
    });
  }}


class FlipCounter {
  constructor(element, value) {
    if (typeof value !== "number") return;

    this.element = element;
    this.targetNumber = value;
    this.targetDigits = [];
    this.numDigits = this.targetNumber.toString().length;
    this.DOMNodes = [];
    this.flipperInstances = [];

    // separate the digits of the value arg
    for (let i = 0; i < this.numDigits; i++) {
      this.targetDigits.push(this.targetNumber.toString()[i]);
    }

    this.populateDOM();
    this.populateInstanceArray();
  }

  // creates wrapper elements for each digit
  populateDOM() {
    this.element.innerHTML = "";

    let i = 0;
    for (i; i < this.numDigits; i++) {
      const container = document.createElement("span");
      container.className = ROOT_CLASS_NAME;

      this.element.appendChild(container);
      this.DOMNodes.push(container);
    }
  }

  // instantiate a DigitFlipper object for each digit
  populateInstanceArray() {
    this.DOMNodes.forEach((digit, index) => {
      this.flipperInstances.push(
      new DigitFlipper(digit, {
        number: this.targetDigits[index],
        iterationCount: 4 }));


    });
  }

  // runs the animation, with a 200ms stagger
  play() {
    this.flipperInstances.forEach((instance, index) => {
      let delay = index * 200;
      setTimeout(() => instance.flip(), delay);
    });
  }}



// kick off the initial one
const counter = new FlipCounter(element, Number(element.dataset.value));
counter.play();
