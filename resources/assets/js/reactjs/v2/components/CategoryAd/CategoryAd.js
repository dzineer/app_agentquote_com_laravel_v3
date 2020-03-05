import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import QuoterContainer from "../Quoter/QuoterContainer";
import InfoBox from "../InfoBox/InfoBox";

/** class CategoryAd */
class CategoryAd extends Component {

    constructor(props) {
        super(props);

        this.state = {
            ad: this.props.ad,
            carriers: this.props.carriers,
            carrier: this.props.carriers.filter( carrier => carrier.checked ),
        };

        this.fieldErrors = {
            carrier_id: "Please choose a preferred carrier.",
            body: "Please provide Ad Text."
        };

        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };

        this.updateField.bind(this);
        this.updateAd.bind(this);
    }

    message = (type, msg) => {
        switch(type) {
            case 'success':
                toastr.success(msg);
                break;
            case 'warn':
                toastr.warn(msg);
                break;
            case 'info':
                toastr.info(msg);
                break;
            case 'error':
                toastr.error(msg);
                break;

            default:
                toastr.info(msg);
        }
    };

    updateCarrierField = (e) => {
        console.log(e.target.name, e.target.value);

        let ad = Object.assign({}, this.state.ad );
        ad.company_id = e.target.value;

        this.setState({ ad } );
    };

    updateField = (e) => {
        e.preventDefault();
        console.log(e.target.name, e.target.value);

        let ad = Object.assign({}, this.state.ad );
        ad[e.target.name] = e.target.value;

        this.setState({ ad } );
    };

    postRequest = (url, data)=>  {
        debugger;
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        return fetch(url,
            {
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                //    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token
                },
                credentials: 'same-origin',
                body: data
            })
    };

    updateAd = (e) => {

        e.preventDefault();

        console.log( this.state.ad );

        if (!this.validate()) {
            return;
        }

        let data = new FormData();

        debugger;

        for ( let key in this.state.ad ) {
            if (this.state.ad.hasOwnProperty(key)) {
                data.append(key, this.state.ad[key]);
            }
        }

        ad.message = tinyMCE.activeEditor.getContent();

        data.append("message", ad.message);

        this.postRequest(this.props.url,
            data
            )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.message("success", data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    let messages = '';

                    for(let prop in data.errors) {
                        if (data.errors.hasOwnProperty(prop)) {
                            messages += "\n" + this.fieldErrors[prop];
                        }
                    }

                    this.message("error", messages);
                }
            })
            .catch(error => {
                console.log(error)
            });

    };

    validate = () => {

        return true;

        /*if (this.state.ad.company_id === 0) {
            this.message("error", "Please select your preferred carrier.");
            return false;
        } else */
        if (this.state.ad.body.length === 0) {
            this.message("error", "Please provide text to your ad.");
            return false;
        }

        return true;
    };

    getCarriers() {
        console.log(this.state.ad);
        console.log(this.state.carriers);
        return (
            this.state.carriers.map(carrier => {
                return <div className="col-md-6">

                    <div className="form-check">

                        <label className="form-check-label">
                            <input className="form-check-input carriers" type="radio"
                                   id={"carrier_" + carrier.company_id}
                                   name="company_id"
                                   value={carrier.company_id}
                                   data-checked={carrier.selected}
                                   checked={ parseInt(this.state.ad.company_id) === parseInt(carrier.company_id ) }
                                   data-products={'carrier_products ' + carrier.name}
                                   onChange={this.updateCarrierField}
                            />
                            {carrier.name}
                        </label>

                    </div>

                </div>
            }))
    }

    render() {

        return (

                <div className="row">
                    <div className="col-md-12">
                        <h4 className="heading-info">{ this.props.labels.preferred_carrier_label } Ad</h4>
                    </div>

                    <div className="col-md-12">
                        <input type="submit"
                               className="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3"
                               value=" Save " onClick={this.updateAd} />
                    </div>

                    <div className="col-md-12">
                        <h4 className="heading-sp my-4">Select Preferred Carrier Ad</h4>
                    </div>

                    { this.state.ad.id !== 0 ? <input type="hidden" name="id" value={this.state.ad.id} /> : "" }

                    {/* carriers go here*/}

                    { this.getCarriers() }

                    <div className="col-md-12">
                        <h4 className="header-sp">Text Advertisement</h4>
                    </div>

                    <div className="col-md-12">
                        <div className="form-group">
                            <textarea className="form-control p-4" rows="1" id="message" name="message" required="">
                            { this.state.ad.message }
                            </textarea>
                        </div>
                    </div>

{/*                    <div className="col-md-6">
                        <div className="form-group">
                            <label htmlFor="ad">URL Link for Text Ad (optional)</label>
                            <textarea className="form-control p-4" rows="1" id="link" name="link" onChange={ this.updateField } maxLength="100"
                                      required >
                            { this.state.ad.link }
                            </textarea>
                        </div>
                    </div>*/}

                    <div className="col-md-12">
                        <input type="submit"
                               className="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3"
                               value=" Save " onClick={this.updateAd} />
                    </div>

                </div>
        );
    }
}

CategoryAd.propTypes = {
    url: PropTypes.string.isRequired,
    ad: PropTypes.object.isRequired,
    carriers: PropTypes.array.isRequired,
    labels: PropTypes.object.isRequired
};

CategoryAd.defaultProps = {
    url: '',
    ad: {},
    carriers: [],
    labels: {}
};

export default CategoryAd;

if (document.getElementById('category-ad')) {
    render(
        <CategoryAd ad={ad} carriers={carriers} url={url} labels={labels} />,
        document.getElementById('category-ad')
    );
}
