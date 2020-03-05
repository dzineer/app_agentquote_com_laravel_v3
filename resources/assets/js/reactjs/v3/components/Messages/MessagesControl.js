import React from 'react';
import PropTypes from 'prop-types';

/** function: MessagesControl */
const MessagesControl = ({onControlClick, onSearch}) => {

    const links = [
        { className: "nav-link small-menu-item", icon: "fa fa-pencil", text: "View", type: "view" },
        { className: "nav-link small-menu-item", icon: "fa fa-trash", text: "Delete", type: "delete" },
    ];

    const list = links.map(link => {
        return (
            <li key={link.type} className="nav-item">
                <a className={link.className} href="" onClick={(e) => onControlClick(link.type, e)}><span className={link.icon} />{link.text}</a>
            </li>
        );
    });

    return (
        <ul className="nav small-nav">
            { list }
            <li className="nav-item">
                <a className="nav-link small-menu-item" href="#"><input type="text" id="search" /><span className="fa fa-search" onClick={(e) => onSearch($('#search').val(), e)} /></a>
            </li>
        </ul>
    );
};

MessagesControl.propTypes = {
    onControlClick: PropTypes.func.isRequired,
    onSearch: PropTypes.func.isRequired
};

export default MessagesControl;