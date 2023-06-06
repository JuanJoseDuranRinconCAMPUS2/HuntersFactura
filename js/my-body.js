
import styles from "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" assert { type: "css" };
export class myBody extends HTMLElement{
    constructor(){
        super();
        document.adoptedStyleSheets.push(styles);

    }
    async components(){
        return await (await fetch("view/my-body.html")).text();
    }
    
    async add(e){
        let $ = e.target;
        if ($.nodeName == "BUTTON") {
            let plantilla = this.querySelector("#products").lastElementChild;
            plantilla = plantilla.cloneNode(true);
            document.querySelector("#products").appendChild(plantilla);
        }
    }

    connectedCallback(){
        this.components().then(html=>{
            this.innerHTML = html;
            this.add = this.querySelector("#add").addEventListener("click", this.add.bind(this));
        });
    }
}
customElements.define('my-body',myBody);