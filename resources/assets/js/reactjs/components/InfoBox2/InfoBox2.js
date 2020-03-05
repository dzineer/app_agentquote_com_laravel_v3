import React, {Component} from 'react';
import ReactDom, {render} from 'react-dom';
import PropTypes from 'prop-types';

/** class InfoBox2 */
class InfoBox2 extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <div className="information-box">
                { this.props.message }
            </div>
        );
    }
}

InfoBox2.propTypes = {
    /** message */
    message: PropTypes.object.isRequired
};

InfoBox2.defaultProps = {
    message: {}
};

export default InfoBox2;

let childMessage = (<div><strong>Be sure to signup for a Microsite to increase your lead flow.</strong></div>);

if (document.getElementById('information-box2')) {
    render(
        <InfoBox2 message={childMessage} />,
        document.getElementById('information-box2')
    );
}