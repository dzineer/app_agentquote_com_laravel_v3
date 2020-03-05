import React, {Component} from 'react';
import PropTypes from 'prop-types';
import Contact from "./Contact";

/** class Contacts */
class Contacts extends Component {
    constructor(props) {
        super(props);
        this.state = {};
        this.contactsArr = [
            { id: "32sdfsd", first_name: "Sara", last_name: "Holder", email: "sholder@gmail.com", phone: "5551212", addr1: "123 Right Way", addr2: "", city: "Fullerton", state: "CA", zipcode: "94523" }
        ];

        this.columnsArr = [
            '',
            'Contact Id',
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Address 1',
            'Address 2',
            'City',
            'State',
            'Zip Code'
        ];
    }

    buildContacts = () => {
      return this.contactsArr.map(contact => {
          return <Contact
                  key={contact.id}
                  id={contact.id}
                  first_name={contact.first_name}
                  last_name={contact.last_name}
                  email={contact.email}
                  phone={contact.phone}
                  addr1={contact.addr1}
                  addr2={contact.addr2}
                  city={contact.city}
                  state={contact.state}
                  zipcode={contact.zipcode} />
      });
    };

    buildColumns = () => {
      return this.columnsArr.map(column => {
          return <th key={column} scope="col">{ column }</th>
      });
    };

    render() {
        return (
            <table className="table table-striped">
                <thead>
                    <tr>
                        { this.buildColumns() }
                    </tr>
                </thead>
                <tbody>
                    { this.buildContacts() }
                </tbody>
            </table>
        );
    }
}

Contacts.propTypes = {
    /** myProp */
    children: PropTypes.object
};

Contacts.defaultProps = {
    //myProp: val
};

export default Contacts;