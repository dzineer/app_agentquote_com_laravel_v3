import React, {Component} from 'react';
import PropTypes from 'prop-types';
import toastr from 'toastr';
import {render} from "react-dom";
import {SortableContainer, SortableElement, SortableHandle} from 'react-sortable-hoc';
import arrayMove from "array-move";

const DragHandle = SortableHandle(() => <span>::</span>);

const SortableItemCopy = SortableElement( ( {value, sortIndex} ) => {
    let page_id = value.page_id;
    let section_id = value.section_id;
    let section = value.section;
    let active = value.active;
    debugger;
    return <li className="list-group-item" style={ { "cursor": "pointer" } }>
        <DragHandle />
        <span className="badge badge-secondary m-x-10" style={ active === 1 ? { "backgroundColor": "green" } : { "backgroundColor": "red" } }>{ sortIndex } </span>
        <a
        href={ '/modules?module=pages_module&page_id=' + page_id + '&section_id=' + section_id }
        style={ { "cursor": "pointer" } }>{ section }</a>
    </li>
});

const SortableContainerCopy = SortableContainer( ( {children} ) => {
    return (
        <ul className="list-group">
            { children }
        </ul>
    );
});

/** class PageMenuItemsList */
class PageSectionsListItems extends Component {
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
        this.updatePageSectionPosition.bind(this);
        this.onSortEnd.bind(this);
    }

    componentDidMount() {
        console.log(this.props.items);

        this.setState({
            items: this.props.items
        });

    }

    updatePageSectionPosition = (page_id, section_id, old_position, new_position) => {

        let fd = new FormData();

        let options = {
            "page_id" : page_id,
            "section_id" : section_id,
            "old_position" : old_position,
            "new_position" : new_position,
        };

        fd.append("options", JSON.stringify( options ));
        fd.append("action", "update");

        axios.post(url, fd).then( res => {
            console.log(res);
            debugger;
            if (res.data.success === true) {
                toastr.success('Position updated');
            } else {
                toastr.error(res.data.message);
            }
        });

    };

    onSortEnd = ({oldIndex, newIndex}) => {

      const { items } = this.state;
      const draggedItem = items[oldIndex];

      console.log("current target: ", draggedItem);
      console.log("current target new position: ", newIndex);

      let that = this;

      this.setState( ({items}) => ({
          items: arrayMove(items, oldIndex, newIndex)
      }), function() {
          debugger;
          that.updatePageSectionPosition( draggedItem.page_id, draggedItem.section_id, oldIndex, newIndex );
      });
    };

    render() {

        const {items} = this.state;

        return (
            <div>
                <p>
                    Note: To re-order sections, drag them up or down. Green badges are enabled, and red disabled.
                </p>
                <SortableContainerCopy onSortEnd={this.onSortEnd} hideSortableGhost={false} >
                    <ul className="list-group">
                        { items && items.map( (value, index) => (
                            <SortableItemCopy key={`item-${value}-${index}`} index={ index } value={ value } sortIndex={ index }  hideSortableGhost={false} />
                        ))}
                    </ul>
                </SortableContainerCopy>
            </div>

        );
    }
}

PageSectionsListItems.propTypes = {
    items: PropTypes.array.isRequired
};

PageSectionsListItems.defaultProps = {
    items: []
};

export default PageSectionsListItems;

if (document.getElementById('page-sections-list')) {
    render(
        <PageSectionsListItems items={ sections } />,
        document.getElementById('page-sections-list')
    );
}
