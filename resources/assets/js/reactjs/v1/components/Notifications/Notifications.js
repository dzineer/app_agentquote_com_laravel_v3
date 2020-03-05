import React, {Component} from 'react';
import PropTypes from 'prop-types';
import Notification from "./Notification";
import Request from '../../utils/FD3Request';
import message from '../../utils/FD3Messaging';

import Echo from  'laravel-echo/dist/echo';

import {render} from "react-dom";

/** className Notifications */
class Notifications extends Component {
    constructor(props) {
        super(props);
        this.state = {
            total: 0,
            can_notify: this.props.can_notify,
            notifications: this.props.notifications
        };
        this.markAllRead.bind(this);
        this.deleteNotification.bind(this);
        this.deleteAllNotifications.bind(this);

        this.echo =  new Echo({
            broadcaster: 'socket.io',
            host: window.location.hostname + ':6001',
        });

        this.echo.channel('test-event')
            .listen('ExampleEvent', event => {
                let newState = Object.assign({}, this.state);
                if (!newState.notifications.length) {
                    newState.notifications = [];
                }
                let notification = event.data.notification;
                notification.data = JSON.parse(notification.data);
                newState.notifications.push(notification);
                debugger;
                this.setState(newState);
                // console.log(JSON.parse(event));
            });

    }

    componentDidMount() {
        let notifications = [
            { title: "New Signup", body: "New Agent signed up.", icon: "/images/aq-notifications-icon.png", action_link: "https://google.com", created_at: '10 minutes ago.'},
            { title: "New Quote", body: "New quote was generated.", icon: "/images/aq-notifications-icon.png", action_link: "https://google.com", created_at: '5 minutes ago.'},
        ];

        notifications = this.props.notifications;

        this.setState({
            notifications
        });

    }

    markAllRead = () => {
        Request.post('/api/notifications/mark/read',
            []
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                debugger;
                if (typeof data.success !== "undefined" && data.success === true) {
                    message.success(data.message);
                    this.setState({
                        notifications: []
                    })
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    message.error(data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    deleteAllNotifications = () => {
        Request.post('/api/notifications/delete/all',
            []
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                debugger;
                if (typeof data.success !== "undefined" && data.success === true) {
                    message.success(data.message);
                    this.setState({
                        notifications: []
                    })
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    message.error(data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    deleteNotification = (notification) => {

        const id = notification.id;

        debugger;

        Request.post('/api/notifications/delete/'+id,
            []
        )
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                console.log(data);
                debugger;
                if (typeof data.success !== "undefined" && data.success === true) {
                    message.success(data.message);
                    debugger;
                    let notifications = Object.assign([], this.state.notifications);

                    notifications = notifications.filter( notification => {
                        return notification.id !== id
                    });

                    this.setState({
                        notifications
                    })
                }
                else if (typeof data.success !== "undefined" && data.success === false) {
                    message.error(data.message);
                }
                else if (typeof data.errors !== "undefined" ) {
                    this.showErrors(data.errors);
                }
            })
            .catch(error => {
                console.log(error)
            });
    };

    renderNotificationsMenu = () => {

        let styles = {
            dropButton: {
                "background": "none",
                "color": "white",
                "padding": "20px 30px",
                "fontSize": "16px",
                "border": "none",
                "cursor": "pointer"
            }
        };

        if (!this.state.notifications.length) {
            return (
                <button className="dropbtn"
                        style={styles.dropButton}>
                    <i data-count="1" className="fa fa-bell notification-bell-empty" />
                </button>
            );
        } else {
            return (
                <button className="dropbtn"
                        style={styles.dropButton}>
                    <i data-count={ this.state.notifications.length} className="fa fa-bell notification-icon notification-bell" />
                </button>
            );
        }
    };

    renderNotification = (notification) => {

        let styles = {
            dropButton: {
                "background": "none",
                "color": "white",
                "padding": "20px 30px",
                "fontSize": "16px",
                "border": "none",
                "cursor": "pointer"
            },
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
                bottomContainer: {
                    body: {
                        "padding": "4px 10px"
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
          <Notification key={notification.id} notification={ notification } onDelete={ this.deleteNotification } />
      )
    };

    renderNotifications = () => {

        let styles = {
            dropButton: {
                "background": "none",
                "color": "white",
                "padding": "20px 30px",
                "fontSize": "16px",
                "border": "none",
                "cursor": "pointer"
            },
            notificationWindow: {
                "minWidth": "415px",
                "padding": "0",
                "borderRadius": "5px",
                topContainer: {
                    "borderBottom": "1px solid #ccc",
                    body: {
                        "padding": "12px 10px",
                        link: {
                            "float": "right"
                        }
                    }
                },
                middleContainer: {
                    "borderBottom": "1px solid #ccc",
                    body: {
                        "padding": "12px 10px"
                    }
                },
                bottomContainer: {
                    body: {
                        "padding": "4px 10px"
                    }
                }
            }
        };

        /*         if (!this.state.notifications.length) {
     /*            return (
                        <div style={styles.notificationWindow}>
                            <div style={styles.notificationWindow.middleContainer}>
                                <div style={styles.notificationWindow.middleContainer.body}>
                                    You don't have any notifications.
                                </div>
                            </div>
                        </div>
                    );
        } */
        if (this.state.notifications.length) {
            return this.state.notifications.map( notification => {
                return this.renderNotification( notification );
            });
        }
    };

    render() {
        let total = 0;
        let styles = {
            dropButton: {
                "background": "none",
                "color": "white",
                "padding": "20px 30px",
                "fontSize": "16px",
                "border": "none",
                "cursor": "pointer"
            },
            notificationWindow: {
                "minWidth": "432px",
                "padding": "0px",
                "borderRadius": "5px",
                "overflowWrap": "break-word",
                topContainer: {
                    "borderBottom": "1px solid #ccc",
                    body: {
                        "padding": "6px 10px",
                        "position": "relative",
                        link: {
                            "position": "absolute",
                            "top":"0",
                            "right":"0",
                            "padding": "6px 10px",
                        }
                    }
                },
                middleContainer: {
                    "borderBottom": "1px solid #ccc",
                    body: {
                        "padding": "4px 10px"
                    }
                }
            }
        };

        if (! this.state.can_notify)
            return;

        return (
            <div className="dropdown">
                { this.renderNotificationsMenu() }
                <div className="dropdown-content">

                    <div style={styles.notificationWindow}>
                        { this.state.notifications.length > 0 && <div style={styles.notificationWindow.topContainer}>
                            <div style={styles.notificationWindow.topContainer.body}>
                                Notifications ({this.state.notifications.length})
                                { this.state.notifications.length > 0 && <a href="#" style={styles.notificationWindow.topContainer.body.link} onClick={this.deleteAllNotifications}>Delete all notifications.</a> }
                            </div>
                        </div> }
                        { this.renderNotifications() }
                    </div>

                </div>
            </div>
        );
    }
}

Notifications.propTypes = {
    /** myProp */
    notifications: PropTypes.array,
    can_notify: PropTypes.array,
};

Notifications.defaultProps = {
    notifications: [],
    can_notify: false
};

export default Notifications;

if (document.getElementById('notifications')) {
    render(
        <Notifications notifications={ userNotifications.notifications } can_notify={ userNotifications.can_notify }/>,
        document.getElementById('notifications')
    );
}