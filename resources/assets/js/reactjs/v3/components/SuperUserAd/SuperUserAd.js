import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';

/** class SuperUserAd */
class SuperUserAd extends Component {

    constructor(props) {
        super(props);

        this.state = {
            ad: this.props.ad,
            url: this.props.url,
            fields: {
                file: null
            }
        };

        this.fieldErrors = {
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
        this.updateFileField.bind(this);
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

    updateFileField = (e) => {
        let fields = Object.assign({}, this.state.fields );
        fields[e.target.name] = e.target.files[0];
        this.setState({ fields } );
    };

    updateField = (e) => {

        console.log(e.target.name, e.target.value);

        let ad = Object.assign({}, this.state.ad );
        ad[e.target.name] = e.target.value;

        this.setState({ ad } );
    };

    postWithFileRequest = (url, data, in_headers)=>  {
        debugger;
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let headers = {
            'Accept': 'application/json',
                //    'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': token
        };

        let post_headers = Object.assign({}, headers, in_headers);

        return fetch(url,
            {
                method: "POST",
                headers: post_headers,
                credentials: 'same-origin',
                body: data
            })
    };

    updateAd = (e) => {

        e.preventDefault();

        console.log( this.state.ad );

        // if (!this.validate()) {
        //     return;
        // }

        let data = new FormData();

        debugger;

        for ( let key in this.state.ad ) {
            if (this.state.ad.hasOwnProperty(key)) {
                data.append(key, this.state.ad[key]);
            }
        }

        let message = tinyMCE.activeEditor.getContent();
        data.append("message", message);

        let in_headers = {};
        debugger;
/*        if (this.state.fields.file) {
/!*            in_headers = {
                'Content-Type': 'multipart/form-data'
            };*!/
            data.append("file", this.state.fields.file);
        }*/

        this.postWithFileRequest(
                this.props.url,
                data,
                in_headers
            )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.message("success", data.message);
                    location.reload();
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
        if (this.state.ad.body.length === 0 && ! this.refs.file.value.length) {
            this.message("error", "Please provide text to your ad.");
            return false;
        }

        return true;
    };

    getImage = () => {
        let style = {
            maxWidth: '100%',
        };
        return <img src={this.state.ad.image_url} alt="ad" style={style} />
    };

    getAd = () => {
        let style = {
            margin: '0 auto',
        };

        if (this.state.ad.link.length) {
            return this.state.ad.image_url !== null ?
                <a href={this.state.ad.link} target="_blank" style={style}>{ this.getImage() }</a> :
                <a href={this.state.ad.link} target="_blank" style={style}>{ this.state.ad.body }</a>
        } else {
            return this.state.ad.image_url !== null ?
                this.getImage() :
                this.state.ad.body
        }
    };

    getImageField = () => {
        debugger;
        let style = {
          hr: {
              marginBottom: '20px',
          },
          containerText: {
            textDecoration: 'italic',
            paddingLeft: '8px'
          },
          container: {
             /* border: '1px solid rgba(0,0,0,0.1)', */
              padding: '8px',
              margin: '20px 0',
          }
        };

        return this.state.ad.image_url !== null ? (
            <div className="col-md-12">
                <div className="form-group">
                    <hr />

                    <i style={style.containerText}>Ad Preview</i>
                    <div style={style.container}>{ this.getAd() }</div>

                    <hr style={style.hr}/>

                    <label htmlFor="image">Ad Image</label>
                    <div>
                        <input type="file" id="file" name="file" accept="image/*" ref="file" onChange={ this.updateFileField } />
                    </div>

                </div>
            </div>
        ) :
            <div className="col-md-12">
                <div className="form-group">
                    <hr />

                    <i style={style.containerText}>Ad Preview</i>
                    <div style={style.container}>{ this.getAd() }</div>

                    <hr style={style.hr}/>

                    <label htmlFor="image">Ad Image</label>
                    <div>
                        <input type="file" id="file" name="file" accept="image/*" ref="file" onChange={ this.updateFileField } />
                    </div>
                    <hr />
                </div>
            </div>;

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
                        <h4 className="heading-info">Header Ad</h4>
                    </div>

                    <div className="col-md-12">
                        <input type="submit"
                               className="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3"
                               value=" Save " onClick={this.updateAd} />
                    </div>

                    {/*{ this.getImageField() }*/}

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

                    {/*<div className="col-md-12">
                        <div className="form-group">
                            <label htmlFor="ad">Text Advertisement</label>
                            <textarea className="form-control p-4" rows="1" id="body" name="body" maxLength="100" onChange={ this.updateField }>
                                { this.state.ad.body }
                            </textarea>
                        </div>
                    </div>

                    <div className="col-md-12">
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

SuperUserAd.propTypes = {
    ad: PropTypes.object.isRequired,
    labels: PropTypes.object.isRequired,
    url: PropTypes.string.isRequired,
};

SuperUserAd.defaultProps = {
    ad: {},
    labels: {},
    url: '',
};

export default SuperUserAd;

if (document.getElementById('super-ad')) {
    render(
        <SuperUserAd ad={superAd} labels={labels} url={url} />,
        document.getElementById('super-ad')
    );
}
