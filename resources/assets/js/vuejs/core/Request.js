class Request {

    static get(url) {
        return this.send("get", url);
    }

    static patch(url, data) {
        return this.send("patch", url, data);
    }

    static delete(url, data) {
        return this.send("delete", url, data);
    }

    static send(requestType, url, data = null) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, data)
            .then(response => {
                resolve(response.data);
            })
            .catch(error => {
                this.errors.record(error.response.data.errors);
                reject(error.response.data)
            });
        });
    }

    static post(url) {
        return this.send("post", url);
    }
}

export default Request;