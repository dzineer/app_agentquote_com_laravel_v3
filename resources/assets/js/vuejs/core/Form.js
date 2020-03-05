import MyErrors from './MyErrors';

class Form {
    constructor(fields) {
        this.originalData = fields;

        for(let field in this.originalData) {
            this[field] = this.originalData[field];
        }

        this.errors = new MyErrors();
    }

    data() {
        let data = {};

        for(let field in this.originalData) {
            data[field] = this[field];
        }

        return data;
    }

    reset() {
        for(let field in this.originalData) {
            this[field] = '';
        }
    }

    get(url) {
        return this.send("get", url);
    }

    patch(url) {
        return this.send("patch", url);
    }

    delete(url) {
        return this.send("delete", url);
    }

    send(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
            .then(response => {
                resolve(response.data);
            })
            .catch(error => {
                this.errors.record(error.response.data.errors);
                reject(error.response.data)
            });
        });
    }

    post(url) {
        return this.send("post", url);
    }
}

export default Form;