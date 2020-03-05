import React, {Component} from 'react';
import PropTypes from 'prop-types';
import EditGroupName from "./EditGroupName";

/** class GroupNameLine */
class GroupNameLine extends Component {

    constructor(props) {
        super(props);

        this.statusDefaults = {
            editing: false,
            edit: false,
            can_save: false,
            cancel: false,
            delete: false
        };

        this.original = {
            group_name: {}
        };

        this.state = {
            edit: false,
            group: {},
            controls: {
                status: {
                    editing: false,
                    edit: false,
                    can_save: false,
                    cancel: false,
                    delete: false
                }
            }
        };

        this.groupChange.bind(this);
        this.saveGroup.bind(this);
        this.onEdit.bind(this);
    }

    saveGroup = (new_group_name) => {
        let newState = Object.assign({}, this.state);
        newState.group.name = new_group_name;
        this.setState( newState );
    };

    groupChange = (new_group_name) => {
        let newState = Object.assign({}, this.state);
        newState.group.description = new_group_name;

        newState.controls.status.can_save = this.original.group_name !== new_group_name;

        this.setState( newState );
    };

    delete

    componentWillMount(){
        this.original.group_name = this.props.group.description;
        this.setState({ group: this.props.group });
    }

    onEdit = (e) => {
        e.preventDefault();

        let control = e.target.getAttribute('data-control');

        let newState = Object.assign({}, this.state);

        newState.controls.status.edit = false;
        newState.controls.status.can_save = false;
        newState.controls.status.save = false;
        newState.controls.status.cancel = false;
        newState.controls.status.delete = false;

        switch(control) {
            case 'edit':
                // set our active status
                newState.controls.status.edit = true;
                break;
            case 'save':
                this.props.onChange(this.state.group);
                break;
            case 'cancel':
                break;
            case 'delete':
                this.props.onDelete(this.state.group);
                break;
            default:
                return;
        }

        this.setState( (prevState) => {
            return {
                newState
            }
        });

    };

    render() {
        return (
            <tr>
                <td>
                    <EditGroupName description={this.state.group.description} edit={this.state.controls.status.edit} onChange={this.groupChange} />
                </td>
                <td>
                    {
                        ! this.state.controls.status.edit &&
                        <a href="#" data-control="edit" onClick={this.onEdit}>Edit</a>
                    }
                    {
                        this.state.controls.status.can_save &&
                        <a href="#" className="btn btn-primary" data-control="save" onClick={this.onEdit}>Save</a>
                    }
                    {
                        this.state.controls.status.edit &&
                        <a href="#" className="btn btn-secondary ml-2" data-control="cancel" onClick={this.onEdit}>Cancel</a>
                    }
                    {
                        this.state.controls.status.edit &&
                        <a href="#" className="btn btn-danger ml-2" data-control="delete" onClick={this.onEdit}>Delete</a>
                    }

                </td>
            </tr>
        );
    }
}

GroupNameLine.propTypes = {
    /** myProp */
    group: PropTypes.object.isRequired,
    onChange: PropTypes.func.isRequired,
    onDelete: PropTypes.func.isRequired
};

GroupNameLine.defaultProps = {
    group: {},
    onChange: () => {},
    onDelete: () => {}
};

export default GroupNameLine;