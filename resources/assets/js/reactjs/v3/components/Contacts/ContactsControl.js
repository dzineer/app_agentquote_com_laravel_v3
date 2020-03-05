import React from 'react';

/** function: ContactsControl */
const ContactsControl = () => {
    const links = [
        { className: "nav-link small-menu-item", icon: "fa fa-pencil", text: "Edit" },
        { className: "nav-link small-menu-item", icon: "fa fa-trash", text: "Delete" },
    ];

    const list = links.map(link => {
        return (
            <li className="nav-item">
                <a className={link.className} href="#"><span className={link.icon} />{link.text}</a>
            </li>
        );
    });
    return (
        <ul className="nav small-nav">
            { list }
            <li className="nav-item">
                <a className="nav-link small-menu-item" href="#"><input type="text"/><span className="fa fa-search" /></a>
            </li>
        </ul>
    );
};

export default ContactsControl;