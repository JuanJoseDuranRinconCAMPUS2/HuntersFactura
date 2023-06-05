import styles from "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" assert { type: "css" };
export class myProducts extends HTMLElement{
    constructor(){
        super();
    }
    async components(){
        return await (await fetch("view/my-products.html")).text();
    }
    sistem(e){
        let $ = e.target;
        if($.nodeName == "BUTTON"){
            let input = this.querySelector(`#Quantity`);
            switch ($.innerHTML) {
                case "-":
                    console.log(input);
                        if(input.name == "Quantity" && input.value==0){
                             document.querySelector(`#${$.dataset.row}`).remove();
                        }else if(input.name == "Quantity"){
                            input.value--;
                       }
                break;
                case "+":
                        if (input.name == "Quantity") {
                            input.value++;
                        }
                break;
            }
        }
    }
    connectedCallback() {
        document.adoptedStyleSheets.push(styles);
        this.components().then(html=>{
            this.innerHTML=html;
            this.container = this.querySelector("#product_0");
            this.container.addEventListener("click", this.sistem);
        })
    }
}

customElements.define("my-products",myProducts);