import React, {Component} from 'react';
import PropTypes from 'prop-types';
import Lead from "./Lead";
import Column from "../Table/Column";
import TableRow from "../Table/TableRow";
import TableHead from "../Table/TableHead";
import Table from "../Table/Table";
import TableBody from "../Table/TableBody";

/** class Leads */
class Leads extends Component {
    constructor(props) {
        super(props);
        this.state = {};
        this.leadsArr = [
            { id: "32sdfsd", first_name: "Sara", last_name: "Holder", email: "sholder@gmail.com", phone: "5551212", premium: "100"}
        ];
        this.columnsArr = [
            '',
            'Lead Id',
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Premium'
        ];
    }

    buildLeads = () => {
      return this.leadsArr.map(lead => {
          return <Lead key={lead.id} id={lead.id} first_name={lead.first_name} last_name={lead.last_name} email={lead.email} phone={lead.phone} premium={lead.premium} />
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
                    { this.buildLeads() }
                </tbody>
            </table>
        );
    }
}

Leads.propTypes = {
    /** myProp */
    children: PropTypes.object
};

Leads.defaultProps = {
    //myProp: val
};

export default Leads;