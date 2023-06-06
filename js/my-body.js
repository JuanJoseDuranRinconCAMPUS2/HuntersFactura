
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
            const count = this.querySelectorAll('my-products').length;
            if (count >= 1) {
                let plantilla = this.querySelector("#products").lastElementChild;
                plantilla = plantilla.cloneNode(true);
                document.querySelector("#products").appendChild(plantilla);
            }
            
        }
    }

    send(e){
        const myProducts = document.querySelector("my-products");
        const inputsProducts = myProducts.querySelectorAll('input');
        let input = document.querySelectorAll("input");
        let info = {}, producto = {}, lista = {}, data = {}, count = 0;
        producto.product = [];
        input.forEach((val, id) => {
            if (id <= 7) {
                info[val.name] = val.value;
            } else if (count <= inputsProducts.length) {
                lista[val.name] = val.value;
                count++;
                if (count == inputsProducts.length) {
                producto.product.push(lista);
                lista = {};
                count = 0;
                }
            }
        });
        data.info = info;
        data.producto = producto.product;
        console.log(data);
    }

    connectedCallback(){
        this.components().then(html=>{
            this.innerHTML = html;
            this.add = this.querySelector("#add").addEventListener("click", this.add.bind(this));
            this.send = this.querySelector("#send").addEventListener("click", this.send.bind(this));
        
        });
    }
}
customElements.define('my-body',myBody);