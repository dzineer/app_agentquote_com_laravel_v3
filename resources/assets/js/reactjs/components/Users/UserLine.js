import React, {Component} from 'react';
import PropTypes from 'prop-types';
import NewGroupWindow from "./NewGroupWindow";
import SelectAffiliateGroups from "./SelectAffiliateGroups";

/** class UserLine */
class UserLine extends Component {

    constructor(props) {
        super(props);
        this.state = {
            selectedGroup: null,
            selectedGroupIndex: this.props.user.group_id,
            groups: this.props.groups,
            user: this.props.user,
            fields: {
                new_group: ''
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
                    <span className="font-medium link">{this.state.user["fname"]}</span>
                </td>

                <td>
                    {this.state.user["lname"]}
                </td>

                <td>
                    <a mailto={this.state.user["email"]} className="font-medium link">{this.state.user["email"]}</a>
                </td>

                {this.props.admin.type_id !== 4 && <td className="center-text">

                    <div className="form-group">

                        <NewGroupWindow show={this.state.states.show.new_group_window} onChange={this.saveGroup} onCancel={this.cancelGroup} />
                        <SelectAffiliateGroups user={this.props.user} groups={this.state.groups} show={this.state.states.show.group_select} selectedId={this.state.selectedGroupIndex} onChange={this.groupChange} />

                    </div>

                </td>}
{/*                <td> { this.state.user["created_at"] }</td>*/}
                <td>
                    <a href="#" style={this.styles.passwordReset} onClick={this.onPasswordReset}> Password Reset </a>
                </td>
            </tr>
        );
    }
}

UserLine.propTypes = {
    /** myProp */
    admin: PropTypes.object.isRequired,
    user: PropTypes.array.isRequired,
    groups: PropTypes.array.isRequired,
    onChange: PropTypes.func.isRequired,
    onUserUpdate: PropTypes.func.isRequired,
    onPasswordReset: PropTypes.func.isRequired,
};

UserLine.defaultProps = {
    admin: {},
    user: [],
    groups: [],
    onChange: () => {},
    onUserUpdate: () => {},
    onPasswordReset: () => {},
};

export default UserLine;
