import styles from "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" assert { type: "css" };
import "./my-product.js";
export class myHeader extends HTMLElement {
  constructor() {
    super();
    this.counter = 0;
    document.adoptedStyleSheets.push(styles);
  }
  async components() {
    return await (await fetch("src/view/body.html")).text();
  }

  add() {
    let clon = this.element_products.cloneNode(true);
    this.querySelector("#products").insertAdjacentElement("beforeend", clon);
    
  }

  send() {
    let Header_bill = document.querySelectorAll("my-header input");
    let Body_bill = document.querySelectorAll("my-body input");
    let data = new FormData();
    let groupedBody_bill = [];
    const headerValues = Array.from(Header_bill).map((input) => [
      input.name,
      input.value,
    ]);

    groupedBody_bill = Array.from(Body_bill).reduce((result, input, index) => {
      const groupIndex = Math.floor(index / 4);
      if (!result[groupIndex]) {
        result[groupIndex] = [];
      }

      result[groupIndex].push([input.name, input.value]);
      return result;
    }, []);

    let list_produc = groupedBody_bill.map((item) => Object.fromEntries(item));

    let obj = {
      header: Object.fromEntries(headerValues),
      body: list_produc,
    };

    console.log(obj);
  }

  connectedCallback() {
    this.components().then((html) => {
      this.innerHTML = html;
      this.element_products = this.querySelector("my-product");
      this.querySelector("#add").addEventListener("click", this.add.bind(this));
      this.querySelector("#send").addEventListener(
        "click",
        this.send.bind(this)
      );
    });
  }
}
customElements.define("my-body", myHeader);
