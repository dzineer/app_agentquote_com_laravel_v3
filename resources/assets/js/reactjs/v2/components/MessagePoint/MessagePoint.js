import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class MessagePoint */
class MessagePoint extends Component {
    constructor(props) {
        super(props);
        this.state = {
            header: props.header,
            hint: props.hint
        };
    }

/*
    componentWillUpdate(nextProps, nextState) {
        console.log('componentWillUpdate');
    }
*/

    render() {
        return (
            <div className="message-point">
                <div>{ this.state.header }</div>
                <div>{ this.state.hint }</div>
            </div>
        );
    }
}

MessagePoint.propTypes = {
    /** header */
    header: PropTypes.object.isRequired,
    /** hint */
    hint: PropTypes.object.isRequired
};

MessagePoint.defaultProps = {
    header: {},
    hint: {}
};

export default MessagePoint;
