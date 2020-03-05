import React from 'react';
import PropTypes from 'prop-types';

/** function: MessageControl */
const MessageControl = ({onControlClick}) => {

    const links = [
        { className: "nav-link small-menu-item", icon: "fa fa-chevron-left", text: "Back", type: "back" },
    ];

    const list = links.map(link => {
        return (
            <li key={link.type} className="nav-item">
                <a className={link.className} href="" onClick={(e) => onControlClick(e)}><span className={link.icon} />{link.text}</a>
            </li>
        );
    });

    return (
        <ul className="nav small-nav">
            { list }
        </ul>
    );
};

MessageControl.propTypes = {
    onControlClick: PropTypes.func.isRequired,
    onSearch: PropTypes.func.isRequired
};

export default MessageControl;