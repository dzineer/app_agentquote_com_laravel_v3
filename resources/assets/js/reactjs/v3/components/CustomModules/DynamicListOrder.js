import React, {Component} from 'react';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import {render} from "react-dom";
import {SortableContainer, SortableElement} from 'react-sortable-hoc';
import arrayMove from "array-move";

const SortableList = SortableContainer( ( {items, hideSortableGhost} ) => {
    this.hideSortableGhost = false;
    return (
        <ul className="list-group">
            { items && items.map( (value, index) => (
                <SortableItem key={`item-${value}`} index={ index } value={ value } sortIndex={ index } />
            ))}
        </ul>
    );
}, {}, ...{"hideSortableGhost":false});

const SortableItem = SortableElement( ( {value, sortIndex} ) => {
    debugger;
    let page_id = value.page_id;
    let section_id = value.section_id;
    let section = value.section;
    return <li className="list-group-item" style={ { "cursor": "pointer" } }><span
        className="badge badge-secondary m-x-10">{ sortIndex } </span><a
        href={ '/modules?module=pages_module&page_id=' + page_id + '&section_id=' + section_id }
        data-index={ sortIndex }
        style={ { "cursor": "pointer" } }>{ section }</a></li>
});

/** class DynamicListOrder */
class DynamicListOrder extends Component {
    constructor(props) {
        super(props);
        this.state = {
            items: null
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };
    }

    SortableItem = SortableElement( ( value ) => {
        return <li>{ value }</li>
    });

    componentDidMount() {
        console.log(this.props.items);

        this.setState({
            items: this.props.items
        });

    }

    renderListItem = (section, page_id, section_id) => {
      return <li className="list-group-item" style="cursor: pointer"><a
          href={ '/modules?module=pages_module&page_id=' + page_id + '&section_id=' + section_id }
          style="cursor: pointer">{ section }</a></li>
    };

    onSortEnd = ({oldIndex, newIndex}, e) => {
      this.setState( ({items}) => ({
          items: arrayMove(items, oldIndex, newIndex)
      }));
    };

    render() {
        return (
            this.state.items && <SortableList items={this.state.items} onSortEnd={this.onSortEnd} hideSortableGhost={true} />
        );
    }
}

DynamicListOrder.propTypes = {
    items: PropTypes.array.isRequired
};

DynamicListOrder.defaultProps = {
    items: []
};

export default DynamicListOrder;

if (document.getElementById('dynamic-list-order')) {
    render(
        <DynamicListOrder items={ sections } />,
        document.getElementById('dynamic-list-order')
    );
}
