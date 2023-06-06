import styles from "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" assert { type: "css" };
export class myProducts extends HTMLElement{
    constructor(){
        super();
    }
    async components(){
        return await (await fetch("view/my-products.html")).text();
    }
    hadledEvent(e){
        (e.type === "click") ? this.sistem(e) : console.log("error");
    }
    sistem(e){
        let $ = e.target;
        if($.nodeName == "BUTTON" ){
            const count = document.querySelectorAll('my-products').length;
            let box = e.target.parentNode.parentNode;
            let inputs = box.querySelectorAll(`input`);  
            switch ($.innerHTML) {
                case "-":
                    inputs.forEach(element => {
                        if (element.name === "Quantity" && element.value == 1) {
                            if (count > 1) {
                                box.parentNode.remove();
                            }
                        }else if (element.name === "Quantity") {
                            element.value--;
                        }
                    });
                break;
                case "+":
                    inputs.forEach(element => {
                        if (element.name == "Quantity") {
                            element.value++;
                        }
                    });
                break;
            }
        }
    }
    connectedCallback() {
        document.adoptedStyleSheets.push(styles);
        this.components().then(html=>{
            this.innerHTML=html;
            this.container = document.querySelector("#products");
            this.container.addEventListener("click", this.sistem);
        })
    }
}

customElements.define("my-products",myProducts);