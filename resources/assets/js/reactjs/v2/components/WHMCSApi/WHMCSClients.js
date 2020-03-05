import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import toastr from "toastr";
import WHMCSClientsTable from "./WHMCSClientsTable";

/** class WHMCSClients */
class WHMCSClients extends Component {
    constructor(props) {
        super(props);
        this.state = {
            status: '',
            clients: []
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        this.loadClients.bind(this);
    }

    componentWillMount() {
        this.loadClients(1);
    }

    loadClients = ( page ) => {
        let url = '/api/app_module/' + '?module='+'whmcs_api_module';
        let fd = new FormData();

        let options = {
            'page': page
        };

        fd.append("options" , JSON.stringify(options) );
        fd.append("action" , 'GetClients' );

        debugger;

        this.setState({
            status: 'Loading clients...',
            clients: [],
            pagination: [],
        });

        axios.post(url, fd).then( res => {
            console.log(res);
            if (res.statusText === "OK") {

                if (res.data.success === true) {
                    debugger;
                    console.log('clients', res.data.clients);
                    this.setState({
                        status: '',
                        clients: res.data.clients,
                        pagination: res.data.pagination,
                    });

                    let that = this;

                } else {
                    console.log(res);
                    this.setState({
                        status: res.data.message
                    });
                }

            }
        });
    };


    render() {

        return (
            <div>

                <div className="row">

                    <div className="col-md-12">
                        <h5 className="heading-info mb-4">Clients</h5>
                    </div>
                </div>

                <div className="text-center">{ this.state.status }</div>
                { this.state.clients.length > 1 &&
                <WHMCSClientsTable
                    clients={ this.state.clients }
                    pagination={ this.state.pagination }
                    onFirst={ this.loadClients }
                    onNext={ this.loadClients }
                    onPrevious={ this.loadClients }
                    onLast={ this.loadClients }
                    onPage={ this.loadClients }
                /> }
            </div>
        );
    }
}

WHMCSClients.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

WHMCSClients.defaultProps = {
    //myProp: val
};

export default WHMCSClients;

if (document.getElementById('whmcs-clients')) {
    render(
        <WHMCSClients />,
        document.getElementById('whmcs-clients')
    );
}
