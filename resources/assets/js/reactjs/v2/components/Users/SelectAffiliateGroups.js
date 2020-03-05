import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class SelectAffiliateGroup */
class SelectAffiliateGroups extends Component {
    constructor(props) {
        super(props);
        this.state = {
            groups: this.props.groups
        };

        this.groupChange.bind(this);
    }

    groupChange = (e) => {
        this.props.onChange(e);
    };

    setSelectedIndex = (group) => {

    };

    render() {
        return (
           this.props.show &&
           <select className="form-control group" onChange={this.groupChange} ref="group">
                <optgroup label="Affiliate Groups" className="group-list">
                    { this.state.groups.map(group => {
                        return <option value={group.id} key={group.id} selected={ this.props.selectedId === group.id }>{group.description}</option>
                    })}
                </optgroup>
                <optgroup label="Actions">
                    <option>Add Group</option>
                </optgroup>
            </select>
        );
    }
}

SelectAffiliateGroups.propTypes = {
    user: PropTypes.object.isRequired,
    groups: PropTypes.array.isRequired,
    show: PropTypes.bool.isRequired,
    onChange: PropTypes.func.isRequired,
    selectedId: PropTypes.number.isRequired
};

SelectAffiliateGroups.defaultProps = {
    user: {},
    groups: [],
    show: false,
    onChange: () => {},
    selectedId: 0
};

export default SelectAffiliateGroups;