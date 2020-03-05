import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import AccountInfo from './AccountInfo';

/** class Account */
class Account extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <AccountInfo name={""} userId={} password={""} />
        );
    }
}

Account.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

Account.defaultProps = {
    //myProp: val
};

const mapStateToProps = (state, ownProps) => {
    return {
        state: state
    }
};

const mapDispatchToProps = dispatch => {
    return {
        actions: bindActionCreators(actions, dispatch)
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(Account);