import React, {Component} from 'react';
import PropTypes from 'prop-types';
import ReactDOM from "react-dom";
import BlockComponent from "../BlockComponent";

/** class BasicSupport */
class BasicSupport extends Component {
    constructor(props) {
        super(props);

        this.state = {
            opened: false,
            supportContainer: null,
            button: {
                currentState: 'opened',
                states: {
                    opened: '/images/life-support-icon.svg',
                    closed: '/images/x-icon.svg'
                }
            },

        };

        this.onToggle.bind(this);

    }

    componentDidMount() {
        this.setState({
            supportContainer: $('#sticky-container')
        });
    }

    onToggle = (e) => {
        e.preventDefault();
        let newState = Object.assign({}, this.state);
        this.state.supportContainer.toggleClass('show');
        newState.opened =  ! this.state.opened;
        newState.button.currentState = newState.opened ? 'closed' : 'opened';
        this.setState(newState);
    };

    render() {
        return (
            <div className="sticky-helper">
                <div id="sticky-container">
                    <div className="support-container">
                        <div>
                            <h4>Welcome to Support</h4>
                            <p>Please choose from the links below.</p>
                        </div>

                        <a href="https://www.agentquoter.com/billing/submitticket.php?step=2&deptid=2"
                           className="contact-link p-y-20">Contact Support</a>

                    </div>
                </div>
                <div className="sticky-button" id="support-button" onClick={ this.onToggle }>
                    <img src={ this.state.button.states[ this.state.button.currentState ] } height="35" width="35"  alt="Support Icon"/>
                    <span className="sticky-info-text">Support</span>
                </div>
            </div>
        );
    }
}

BasicSupport.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

BasicSupport.defaultProps = {
    //myProp: val
};

export default BasicSupport;


if (document.getElementById('basic-support-popup')) {
    ReactDOM.render(<BasicSupport />, document.getElementById('basic-support-popup'));
}

