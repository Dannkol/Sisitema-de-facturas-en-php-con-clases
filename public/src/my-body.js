export class myBody extends HTMLElement {
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