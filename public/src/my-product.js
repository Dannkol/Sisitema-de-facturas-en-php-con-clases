import styles from "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" assert { type: "css" };
export class myHeader extends HTMLElement {
  constructor() {
    super();
    this.counter = 0;
    
    
  }
  async components() {
    return await (await fetch("src/view/product.html")).text();
  }

  selections(e) {
   
    console.log(e.target.parentNode.parentNode);

    let inputs =
      e.target.nodeName == "BUTTON"
        ? e.target.parentNode.parentNode.querySelectorAll(`input`)
        : null;

    e.target.textContent === "-"
      ? inputs.forEach((input) =>
          input.name == "amount" && input.value == 0
            ? e.target.parentNode.parentNode.parentNode.remove()
            : input.name == "amount"
            ? input.value--
            : false
        )
      : false;

    if (e.target.textContent === "+") {
      inputs.forEach((input) =>
        input.name == "amount" ? input.value++ : null
      );

      /* this.counter++;
      let clonar = document.querySelector(`#${e.target.dataset.row}`);
      let clon = clonar.cloneNode(true);
      clon.id = `product${this.counter}`;
      clon
        .querySelectorAll("button")
        .forEach((elemnt) => (elemnt.dataset.row = `product${this.counter}`));
      this.appendChild(clon); */
    }
  }

  connectedCallback() {
    document.adoptedStyleSheets.push(styles);
    this.components().then((html) => {
      this.innerHTML = html;
      this.container = document.querySelector("#products");
      this.container.addEventListener("click", this.selections);
    });
  }
}
customElements.define("my-product", myHeader);
