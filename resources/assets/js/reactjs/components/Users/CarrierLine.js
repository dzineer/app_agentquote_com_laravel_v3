import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class CarrierLine */
class CarrierLine extends Component {

    constructor(props) {
        super(props);
        this.state = {
            user: this.props.user,
            carrier: this.props.carrier,
        };
        this.onChange.bind(this);
        this.onDelete.bind(this);
    }

    getCategory = (category_id) => {
      let categories = [];
      categories['1'] = 'Underwritten Term';
      categories['2'] = 'SI Term';
      categories['4'] = 'FE (SIWL)';

      return categories[ category_id ];
    };

    onDelete = (e) => {
        e.preventDefault();
        this.props.onDelete(this.state.quote);
    };

    onChange = (e) => {
        this.props.onChange(this.state.quote);
    };

    render() {

        return (

            <tr>
                <td>
                    <div>
                        <span className="font-medium link">{ this.state.carrier }</span>
                    </div>
                </td>
            </tr>
        );
    }
}

CarrierLine.propTypes = {
    /** myProp */
    user: PropTypes.object.isRequired,
    carrier: PropTypes.array.isRequired,
    onChange: PropTypes.func.isRequired,
    onDelete: PropTypes.func.isRequired,
};

CarrierLine.defaultProps = {
    user: [],
    quote: [],
    onChange: () => {},
    onDelete: () => {},
};

export default CarrierLine;