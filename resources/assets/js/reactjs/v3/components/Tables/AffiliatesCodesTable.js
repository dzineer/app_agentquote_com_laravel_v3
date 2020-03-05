import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import Request from '../../utils/FD3Request';
import Pagination from "./Pagination";
import AffiliateCodeLine from "./AffiliateCodeLine";

/** class AffiliatesCodesTable */
class AffiliatesCodesTable extends Component {

    constructor(props) {
        super(props);

        this.state = {
            coupons: this.props.coupons,
            affiliates: [
                { affiliate_id: 1, name: 'Agent Quote', code: '8549JJLKDF' },
                { affiliate_id: 2, name: 'Other', code: 'SDFK4809FSDF' },
            ],
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

        this.AFFILIATE_USER = 2;
        this.PROGRAM_USER = 5;

       this.onGroupChange.bind(this);
       this.enableUser.bind(this);
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

    updateGroups = (new_group, data) => {
        let newState = Object.assign({}, this.state);
        newState.groups.push(data.group);
        this.setState(newState);
        this.message("success", data.message);
    };

    showErrors = (errors) => {
        let messages = '';

        for(let prop in errors) {
            if (errors.hasOwnProperty(prop)) {
                messages += "\n" + this.fieldErrors[prop];
            }
        }
        this.message("error", messages);
    };

    sanitizeGroupName = (g) => {
        g = g.trim();
        g = g.replace(/[^A-Za-z0-9\s]/g,'');
        g = g.replace(/_/gi, "");
        g = g.replace(/ +(?= )/g,'');
        g = g.trim();
        return g;
    };

    componentWillMount() {
    }

    onGroupChange = (new_group, user, cb) => {

        let safe_description = this.sanitizeGroupName(new_group);
        let name = safe_description.replace(/\s/gi, "_").toLowerCase();

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
            "name": name,
            "description": safe_description,
            "user_id": user.user_id
        });

        Request.post('/api/affiliate/groups',
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.updateGroups(safe_description, data);
                    cb(data);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    this.message('error', data.message);
                    cb(data);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });

    };

    enableUser = (e) => {

        e.preventDefault();

        if (!this.state.selected_user) {
            this.message("error", "Error, You must first select a user.");
            return false;
        }

        let data = Request.toDataForm({
            "user_id": this.state.selected_user.user_id,
            "active": "1"
        });

        let url = '';

        if (this.state.selected_user.type_id === this.AFFILIATE_USER) {
            url = '/api/affiliate/update';
        } else if (this.state.selected_user.type_id === this.PROGRAM_USER) {
            url = '/api/user/update';
        }

        console.log(this.state.selected_user);

        Request.put(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                debugger;
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.message("success", data.message);
                    let newState = Object.assign({}, this.state);
                    newState.agents = newState.agents.map(agent => {
                        debugger;
                        if (this.state.selected_user.user_id === agent.user_id) {
                            agent.active = 1;
                            return agent;
                        } else {
                            return agent;
                        }
                    });
                    newState.selected_user = null;
                    this.setCheckboxes( false );
                    this.setState(newState);
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    this.message('error', data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });

    };

    updateUser = (user, action) => {

        let data = Request.toDataForm({
            "user_id": user.user_id,
        });

        let url = '/api/super/user';

        console.log(user);

        return;

        Request.put(url,
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
                else if (typeof data.success !== "undefined" && data.success === false) {
                    this.message('error', data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    render() {

        let styles = {
            checkbox: {
                textAlign: 'center'
            }
        };

        return (

            <div className="row">

                <div className="col-md-12">

                    <div className="_fd3-table-responsive">
                        <table className="table table-striped table-bordered tablesorter">
                            <thead>
                            <tr>
                                <th>Affiliate
                                </th>
                                <th className="sheader">Code
                                </th>
                                <th className="sheader">Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            { this.state.coupons.map( coupon => {
                                return <AffiliateCodeLine coupon={coupon} />
                            })}

                            </tbody>
                        </table>
                    </div>

                    {/*<Pagination pagination={pagination} />*/}

                </div>

            </div>
        );
    }
}

AffiliatesCodesTable.propTypes = {
   // user: PropTypes.object.isRequired,
    coupons: PropTypes.array.isRequired,
   // pagination: PropTypes.array
};

AffiliatesCodesTable.defaultProps = {
   // user: {},
    coupons: [],
   //  pagination: []
};

export default AffiliatesCodesTable;

if (document.getElementById('affiliates-codes-table')) {
    debugger;
    render(
        <AffiliatesCodesTable coupons={$coupons} />,
        document.getElementById('affiliates-codes-table')
    );
}
