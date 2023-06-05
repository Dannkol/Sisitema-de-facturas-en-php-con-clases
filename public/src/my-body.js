import styles from "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" assert { type: "css" };
import './my-product.js';
export class myHeader extends HTMLElement {
  constructor() {
    super();
  }
  async components() {
    return await (await fetch("src/view/body.html")).text();
  }



  connectedCallback() {
    document.adoptedStyleSheets.push(styles);
    this.components().then((html) => {
      this.innerHTML = html;
      
    });
  }
}
customElements.define("my-body", myHeader);
