import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class EditGroupName */
class EditGroupName extends Component {
    constructor(props) {
        super(props);
        this.state = {
            description: this.props.description
        };

        this.fieldChanged.bind(this);
        this.saveGroup.bind(this);
    }

    saveGroup = () => {
        this.props.onChange(this.state.new_group);
        this.setState({ description: ''});
    };

    fieldChanged = (e) => {
        this.props.onChange(e.target.value);
        this.setState({ description: e.target.value} );
    };

    render() {
        return (

            <div>
                { ! this.props.edit &&
                   <span className="font-medium link" ref="name">{this.state.description}</span>
                }

                { this.props.edit &&
                    <span className="font-medium link input-group" ref="edit_name"><input type="text" className="form-control responsive-input" value={this.state.description} onChange={this.fieldChanged} /></span>
                }
            </div>
        );
    }
}

EditGroupName.propTypes = {
    show: PropTypes.bool.isRequired,
    onChange: PropTypes.func.isRequired
};

EditGroupName.defaultProps = {
    show: false,
    onChange: () => {}
};

export default EditGroupName;