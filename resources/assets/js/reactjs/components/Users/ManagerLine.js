import React, {Component} from 'react';
import PropTypes from 'prop-types';
import NewGroupWindow from "./NewGroupWindow";
import SelectAffiliateGroups from "./SelectAffiliateGroups";
import message from "../../utils/FD3Messaging";

/** class ManagerLine */
class ManagerLine extends Component {

    constructor(props) {
        super(props);
        this.state = {
            selectedGroup: null,
            selectedGroupIndex: this.props.user.group_id,
            groups: this.props.groups,
            user: this.props.user,
            fields: {
                new_group: '',
                fname: this.props.user["fname"],
                lname: this.props.user["lname"],
                email: this.props.user["email"],
            },
            edit_field: false,
            edit_fields: {
                state: {
                    fname: false,
                    lname: false,
                    email: false
                }
            },
            states: {
                show: {
                    group_select: true,
                    new_group_window: false
                }
            }
        };
        this.styles = {
            passwordReset: {
                marginRight: '10px'
            }
        };
        this.groupChange.bind(this);
        this.saveGroup.bind(this);
        this.cancelGroup.bind(this);
        this.onPasswordReset.bind(this);
        this.onFieldChange.bind(this);
        this.updateManager.bind(this);
    }

    cancelGroup = (e) => {
        e.preventDefault();
        let newState = Object.assign({}, this.state );
        newState.states.show.new_group_window = false;
        newState.states.show.group_select = true;
        this.setState( newState );
    };

    saveGroup = (new_group_name) => {

        this.props.onChange(new_group_name, this.props.user, function(data) {
            let newState = Object.assign({}, this.state );

            if (typeof data.success !== "undefined" && data.success === false) {
                return;
            }

            newState.states.show.new_group_window = false;
            newState.states.show.group_select = true;

            newState.selectedGroupIndex = data.group.id;
            this.setState(newState);

        }.bind(this));
    };

    groupChange = (e) => {

        if (e.target.value === 'Add Group') {
            let states = Object.assign({}, this.state.states );
            states.show.group_select = false;
            states.show.new_group_window = true;
            this.setState({ states });
        } else {
            this.props.onUserUpdate(this.state.user, e.target.value);
        }

    };

    updateManager = (e) => {
        e.preventDefault();
        debugger;
        if (this.state.user.fname !== this.state.fields.fname) {
            this.props.onManagerUpdate({
                user_id: this.state.user.user_id,
                fname: this.state.fields.fname,
            });
            message.success('Manager being updated...');
        } else if (this.state.user.lname !== this.state.fields.lname) {
            this.props.onManagerUpdate({
                user_id: this.state.user.user_id,
                lname: this.state.fields.lname
            });
            message.success('Manager being updated...');
        } else if (this.state.user.email !== this.state.fields.email) {
            this.props.onManagerUpdate({
                user_id: this.state.user.user_id,
                email: this.state.fields.email
            });
            message.success('Manager being updated...');
        } else {
            message.info('Nothing changed.');
        }

        let edit_fields = Object.assign({}, this.state.edit_fields);

        // reset all edit field states

        for(let prop in edit_fields.state) {
            edit_fields.state[prop] = false;
        }

        this.setState({
            edit_fields
        });

    };

    toggleNField = (name, e) => {
        e.preventDefault();
        debugger;
        let edit_fields = Object.assign({}, this.state.edit_fields);
        edit_fields.state[name] = ! edit_fields.state[name];
        this.setState({
            edit_fields
        });
    };

    renderNField = (field) => {
        return this.state.edit_fields.state[field] &&
            <div>
                <span><form className="form-inline"><input type="text" className="form-control mr-sm-2" value={ this.state.fields[field] } name={field} onChange={ this.onFieldChange } /><input type="button" className="btn btn-primary btn-md ml-2" value="Update" onClick={ this.updateManager } /><input type="button" className="btn btn-danger btn-md ml-2" value="Cancel" onClick={(e) => this.toggleNField(field, e)} /></form></span>
            </div>
    };

    onFieldChange = (e) => {
        let fields = Object.assign({}, this.state.fields);
        fields[e.target.name] = e.target.value;
        this.setState({
            fields
        });
    };

    renderNReadOnly = (field) => {
        let style = {
            "cursor": "pointer"
        };
        return ! this.state.edit_fields.state[field] && <span className="link">{ this.state.fields[field] }<a onClick={(e) => this.toggleNField(field, e)} className="mr-sm-2 edit-item" style={style} ><i className="fa fa-pencil-square-o mx-2" aria-hidden="true" /></a></span>;
    };

    renderNEditField = (field) => {
        return (
            <div>
                { this.renderNField(field) }
                { this.renderNReadOnly(field) }
            </div>
        );
    };

    onPasswordReset = (e) => {
        e.preventDefault();
        debugger;
        this.props.onPasswordReset(this.state.user);
    };

    render() {
        debugger;
        return (
            <tr>
                <td>
                    { this.renderNEditField('fname') }
                </td>
                <td>
                    { this.renderNEditField('lname') }
                </td>

                <td>
                    { this.renderNEditField('email') }
                </td>

                {this.props.admin.type_id !== 4 && <td className="center-text">

                    <div className="form-group">

                        <NewGroupWindow show={this.state.states.show.new_group_window} onChange={this.saveGroup} onCancel={this.cancelGroup} />
                        <SelectAffiliateGroups user={this.props.user} groups={this.state.groups} show={this.state.states.show.group_select} selectedId={this.state.selectedGroupIndex} onChange={this.groupChange} />

                    </div>

                </td>}
                <td>
                    <a href="#" className="btn btn-primary btn-md" style={this.styles.passwordReset} onClick={this.onPasswordReset}> Password Reset </a>
                </td>
            </tr>
        );
    }
}

ManagerLine.propTypes = {
    /** myProp */
    admin: PropTypes.object.isRequired,
    user: PropTypes.array.isRequired,
    groups: PropTypes.array.isRequired,
    onChange: PropTypes.func.isRequired,
    onUserUpdate: PropTypes.func.isRequired,
    onPasswordReset: PropTypes.func.isRequired,
};

ManagerLine.defaultProps = {
    admin: {},
    user: [],
    groups: [],
    onChange: () => {},
    onUserUpdate: () => {},
    onPasswordReset: () => {},
};

export default ManagerLine;
