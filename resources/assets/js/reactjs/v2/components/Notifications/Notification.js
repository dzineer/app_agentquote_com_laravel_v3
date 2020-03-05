import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import AgentsTable from "../Users/AgentsTable";
import Notifications from "./Notifications";

/** class Notification */
class Notification extends Component {
    constructor(props) {
        super(props);
        this.state = {
            notification: this.props.notification
        };
        this.onDelete.bind(this);
    }

    onDelete = (e) => {
        e.preventDefault();
        debugger;
        this.props.onDelete(this.state.notification);
    };

    render() {

        let styles = {
            notificationWindow: {
                "minWidth": "280px",
                "padding": "0",
                "borderRadius": "5px",
                topContainer: {
                    "borderBottom": "1px solid #ccc",
                    body: {
                        "padding": "12px 10px"
                    }
                },
                middleContainer: {
                    "borderBottom": "1px solid #ccc",
                    "minHeight": "86px",
                    body: {
                        "minHeight": "86px",
                        "padding": "12px 10px",
                        "position": "relative",
                        "overflowY": "scroll"
                    }
                },
                leftContainer: {
                    "width": "70px",
                    "position": "absolute",
                    "left": "4px",
                    "top": "4px",
                    body: {
                        "padding": "4px 8px",
                        icon: {
                            "width": "64px"
                        }
                    }
                },
                rightContainer: {
                    "position": "absolute",
                    "left": "90px",
                    "top": "10px",
                    title: {
                        "marginBottom": "0.1rem",
                        "color": "#3c8dbc"
                    },
                    body: {
                        "marginBottom": "0.1rem"
                    },
                    created_at: {
                        "fontStyle": "italic",
                        "marginTop": "-4px"
                    }
                },
                cleanbtn: {
                    "position": "absolute",
                    "cursor": "pointer",
                    "right": "0px",
                    "top": "0px",
                }
            }
        };

        return (
            <div style={styles.notificationWindow.middleContainer}>
                <div style={styles.notificationWindow.middleContainer.body}>

                  <span style={styles.notificationWindow.cleanbtn}>
                      <a href="#" onClick={this.onDelete} data-notification-id={this.state.notification.id}> <i className="fa fa-times" /> </a>
                  </span>

                    <div style={styles.notificationWindow.leftContainer}>
                        <div style={styles.notificationWindow.leftContainer.body}>
                            <img alt="Notification Icon" style={styles.notificationWindow.leftContainer.body.icon} src={ this.state.notification.data.icon } />
                        </div>
                    </div>

                    <div style={styles.notificationWindow.rightContainer}>
                        <h5 style={styles.notificationWindow.rightContainer.title}>{ this.state.notification.data.title }</h5>
                        <p style={styles.notificationWindow.rightContainer.body}>{ this.state.notification.data.body }</p>
                        <p style={styles.notificationWindow.rightContainer.created_at}>{ this.state.notification.created_at }</p>
                    </div>

                </div>
            </div>
        );
    }
}

Notification.propTypes = {
    /** myProp */
    notification: PropTypes.object.isRequired,
    onDelete: PropTypes.func.isRequired
};

Notification.defaultProps = {
    notification: {},
    onDelete: () => {},
};

export default Notification;
