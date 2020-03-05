import Request from '../core/Request';

class Status {
    static all(onSuccess, onFailure) {
        return Request.get('/statuses')
            .then(data => {
                this.statuses = data;
                onSuccess(this.statuses);
            })
            .catch(errors => {
                onFailure(errors);
            });
    }

    static add(onSuccess, onFailure, data) {
        return Request.post('/statuses', data)
            .then(data => {
                this.statuses = data;
                onSuccess(this.statuses);
            })
            .catch(errors => {
                onFailure(errors);
            });
    }
}

export default Status;