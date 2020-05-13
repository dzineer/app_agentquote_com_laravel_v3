import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import toastr from "toastr";
import WHMCSProductsTable from "./WHMCSProductsTable";

/** class WHMCSProducts */
class WHMCSProducts extends Component {
    constructor(props) {
        super(props);
        this.state = {
            status: '',
            products: []
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        this.loadProducts.bind(this);
    }

    componentWillMount() {
        this.loadProducts(1);
    }

    loadProducts = ( page ) => {
        let url = '/api/app_module/' + '?module='+'whmcs_api_module';
        let fd = new FormData();

        let options = {
            'page': page
        };

        fd.append("options" , JSON.stringify(options) );
        fd.append("action" , 'GetProducts' );

        debugger;

        this.setState({
            status: 'Loading products...',
            products: [],
            pagination: [],
            fields: []
        });

        axios.post(url, fd).then( res => {
            console.log(res);
            if (res.status === 200) {

                if (res.data.success === true) {
                    debugger;
                    console.log('products', res.data.products);
                    this.setState({
                        status: '',
                        products: res.data.products,
                        pagination: res.data.pagination,
                        fields: res.data.fields,
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
                        <h5 className="heading-info mb-4">Products</h5>
                    </div>
                </div>

                <div className="text-center">{ this.state.status }</div>
                { this.state.products.length > 1 &&
                <WHMCSProductsTable
                    fields={ this.state.fields }
                    products={ this.state.products }
                    pagination={ this.state.pagination }
                    onFirst={ this.loadProducts }
                    onNext={ this.loadProducts }
                    onPrevious={ this.loadProducts }
                    onLast={ this.loadProducts }
                    onPage={ this.loadProducts }
                /> }
            </div>
        );
    }
}

WHMCSProducts.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

WHMCSProducts.defaultProps = {
    //myProp: val
};

export default WHMCSProducts;

if (document.getElementById('whmcs-products')) {
    render(
        <WHMCSProducts />,
        document.getElementById('whmcs-products')
    );
}
