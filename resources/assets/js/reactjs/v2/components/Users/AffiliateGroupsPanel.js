import React, { Component } from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import GroupNameLine from "./GroupNameLine";
import Request from "../../utils/FD3Request";
import BSPanel from "../Bootstrap/4/components/BSPanel";
import NewGroupPanel from "./NewGroupPanel";

/** class CategoryAd */
class AffiliateGroupsPanel extends Component {

    constructor(props) {
        super(props);

        this.state = {
            show_add_group: false,
            new_group: {
                affiliate_id: this.props.affiliate_id,
                description: '',
                name: ''
            },
            affiliate_id: this.props.affiliate_id,
            groups: this.props.groups
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

       this.onGroupChange.bind(this);
       this.onAddGroupClick.bind(this);
       this.onGroupAdd.bind(this);
       this.onDelete.bind(this);
    }

    showErrors = (errors) => {
        let messages = '';

        for(let prop in errors) {
            if (errors.hasOwnProperty(prop)) {
                messages += "\n" + this.fieldErrors[prop];
            }
        }

        this.message("error", messages);
    };

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

    sanitizeGroupName = (g) => {
        g = g.trim();
        g = g.replace(/[^A-Za-z0-9\s]/g,'');
        g = g.replace(/_/gi, "");
        g = g.replace(/ +(?= )/g,'');
        g = g.trim();
        return g;
    };

    fieldChanged = (e) => {
        let new_group = Object.assign({}, this.state.new_group);
        new_group.description = e.target.value;
        this.setState( { new_group } );
    };

    onGroupAdd = (new_group) => {

        debugger;
        let safe_description = this.sanitizeGroupName(new_group);
        let name = safe_description.replace(/\s/gi, "_").toLowerCase();

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
            "name": name,
            "description": safe_description
        });

        let url = '/api/affiliate/groups';

        Request.post(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.message("success", data.message);

                    let newState = Object.assign({}, this.state);
                    newState.new_group.description = '';
                    newState.new_group.name = '';
                    newState.show_add_group = false;

                    newState.groups.push(data.group);

                    this.setState( newState );

                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    this.message("error", data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    onAddGroupClick = (e) => {
      e.preventDefault();
        this.setState({ show_add_group: true });
    };

    onCancel = () => {
        this.setState({ show_add_group: false });
    };

    onGroupChange = (group) => {

        let safe_description = this.sanitizeGroupName(group.description);
        let name = safe_description.replace(/\s/gi, "_").toLowerCase();

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
            "name": name,
            "description": safe_description,
        });

        let url = '/api/affiliate/groups/'+group.id;

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
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    onDelete = (delete_group) => {

        let data = Request.toDataForm({
            "affiliate_id": this.state.affiliate_id,
        });

        let url = '/api/affiliate/groups/'+delete_group.id;

        Request.delete(url,
            data
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                if (typeof data.success !== "undefined" && data.success === true) {
                    this.message("success", data.message);
                    // find and remove delete group
                    let newState = Object.assign({}, this.state);

                    newState.new_group.description = '';
                    newState.new_group.name = '';
                    newState.show_add_group = false;

                    newState.groups = this.state.groups.filter( group => {
                       return group.id !== delete_group.id;
                    });

                    this.setState(newState);
                }
                else if(typeof data.success !== "undefined" && data.success === false) {
                    this.message("error", data.message);
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

        return (

            <div>

                <div className="col-md-12">

                    <a href="#" className="btn btn-secondary my-20" onClick={this.onAddGroupClick}>+Add Group</a>

                    <NewGroupPanel onCancel={this.onCancel} onGroupAdd={this.onGroupAdd} show={this.state.show_add_group} />

                </div>


                <div className="col-md-12">
                    <div className="card">
                        <div className="card-body">

                            <div className="row">

                                <div className="col-md-12">
                                    <h4 className="heading-info">Groups</h4>
                                </div>

                                <div className="col-md-12">

                                    <div className="_fd3-table-responsive">
                                        <table className="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            { this.state.groups.map(group => {
                                                return (
                                                    <GroupNameLine group={group} onChange={this.onGroupChange} onDelete={this.onDelete} />
                                                )

                                            })}

                                            </tbody>
                                        </table>
                                    </div>

                                </div>


                            </div>

                        </div>

                    </div>

                </div>




            </div>

        );
    }
}

AffiliateGroupsPanel.propTypes = {
    affiliate_id: PropTypes.number.isRequired,
    groups: PropTypes.array.isRequired
};

AffiliateGroupsPanel.defaultProps = {
    affiliate_id: 0,
    groups: []
};

export default AffiliateGroupsPanel;

if (document.getElementById('affiliate-groups-panel')) {
    render(
        <AffiliateGroupsPanel groups={groups} affiliate_id={affiliate_id} />,
        document.getElementById('affiliate-groups-panel')
    );
}
