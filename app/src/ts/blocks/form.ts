export class Form {
    element: HTMLFormElement = null

    /**
     * @param {string} selector 
     * @returns {Form}
     */
    constructor(selector: string = '') {
        this.element = document.querySelector(selector);
        this.attachEvents();
        return this;
    }

    attachEvents() {
        this.element.addEventListener('submit', (e) => {
            e.preventDefault();
        });
    }

    setResult(res: string = '') {
        this.element.querySelector('#result').innerHTML = res;
    }
}