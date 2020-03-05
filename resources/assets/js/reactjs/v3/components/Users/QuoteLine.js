import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class QuoteLine */
class QuoteLine extends Component {

    constructor(props) {
        super(props);
        this.state = {
            user: this.props.user,
            quote: this.props.quote,
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

    getIfAgent = () => {
        let styles = {
            checkbox: {
                textAlign: 'center'
            }
        };

        if (this.state.user.type_id === 5) {
            return (
                <td style={styles.checkbox} >
                    <input type="checkbox" className="" value={ this.state.quote.id } checked={ this.props.checked } onChange={this.onChange} />
                </td>
            );
        } else {
            return '';
        }
    };

    numberWithCommas = (x) => {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    };

    formatNum = (n) => {
        debugger;
        if (n === 0) {
            return ' ';
        }

        if ( n.indexOf(".") !== -1 ) {
            // found a string decimal

            let final_num = parseFloat(n).toFixed(2);
            final_num = numberWithCommas(final_num);

            return final_num;

            let pieces = n.split(".");
            let left = pieces[0];
            let right = pieces[1];
            right = right.toString();

            if (right.length > 2) {
                right = right.replace(/0/g, '');
            }

            debugger;
            while(right.length < 2) {
                right = right + "0";
            }
            return left + "." + right;
        }
    };

    buildNumber = (n) => {
        let n1 = n*1000;
        let n2 = this.numberWithCommas(n1);
        return n2;
    };

    render() {

        return (

            <tr>

                { this.getIfAgent() }

                <td>
                    <div>
                        <span className="font-medium link">{ this.state.quote.age }</span>
                    </div>
                </td>

                <td>
                    <div>
                        <span className="font-medium link">{ this.state.quote.state }</span>
                    </div>
                </td>

                <td>
                    <div>
                        <span className="font-medium link">{ this.state.quote.created_at }</span>
                    </div>
                </td>

                <td>
                    <div>
                        <span className="font-medium link">{ this.state.quote.month }/{ this.state.quote.day }/{ this.state.quote.year }</span>
                    </div>
                </td>

                <td>
                    <div>
                        <span className="font-medium link">
                            { this.state.quote.gender }
                        </span>
                    </div>
                </td>

                <td>
                    <div>
                        <span className="font-medium link">
                            { this.state.quote.term }
                        </span>
                    </div>
                </td>

                <td>
                    <div>
                        <span className="font-medium link">
                            { this.buildNumber(this.state.quote.benefit) }
                        </span>
                    </div>
                </td>
                <td>
                    <div>
                        <span className="font-medium link">
                            { this.getCategory(this.state.quote.category) }
                        </span>
                    </div>
                </td>

            </tr>
        );
    }
}

QuoteLine.propTypes = {
    /** myProp */
    user: PropTypes.object.isRequired,
    quote: PropTypes.array.isRequired,
    checked: PropTypes.bool.isRequired,
    onChange: PropTypes.func.isRequired,
    onDelete: PropTypes.func.isRequired,
};

QuoteLine.defaultProps = {
    user: [],
    quote: [],
    checked: false,
    onChange: () => {},
    onDelete: () => {},
};

export default QuoteLine;