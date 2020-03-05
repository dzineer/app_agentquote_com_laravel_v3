@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Recent Quotes
@endsection

@section('content_header')
    <h1>Inbox</h1>
@stop

@section('run_in_header')

    <link href="{{ asset('css/toastr.min.css') }}" />
    <link href="{{ asset('vendor/laravel-filemanager/css/lfm.css') }}" />
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/bootbox/bootbox.all.min.js') }}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/script.js') }}"></script>
    <script src="{{ asset('js/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/tinymce-config.js') }}"></script>
    <script src="{{ asset('js/request.js') }}"></script>
    <script src="{{ asset('js/messaging.js') }}"></script>

    <script type="application/javascript">
        const users = {!! $usersString !!};
        let selectedGroup = 0;
        let selectedUser = 0;

        function sendMessage(e) {

            let message = tinyMCE.activeEditor.getContent();
            let subject = document.querySelector('#subject').value;

            let data = Request.toDataForm({
                "group_id": 0,
                "user_id": selectedUser,
                "subject": subject,
                "message": message
            });

            let url = '/api/message';

            Request.post(url,
                data
            )
                .then((res) => {
                    return res.json();
                })
                .then((data) => {
                    console.log(data);
                    if (typeof data.success !== "undefined" && data.success === true) {
                        messaging.success(data.message);
                        document.location.href = '/messages';
                        return true;
                    }
                    else if (typeof data.success !== "undefined" && data.success === false) {
                        messaging.error(data.message);
                    }
                })
                .catch(error => {
                    console.log(error)
                });

                return false;
        }


        function selectContact(e) {
            if ( e.selectedIndex === 0 )
                return;

            const contact = e.options[ e.selectedIndex ];

            selectedUser = contact.value;

            var el = document.querySelector('#contact-name');
            el.disabled = false;
            el.value = contact.text;
            el.disabled = true;
            var search = document.querySelector('#search-contacts');
            search.value = '';
            var preview = document.querySelector('#contact-preview');
            preview.innerHTML = '';
            showTally();
        }

        function showTally() {
            console.log("Tally: ");
            console.log("-------------------------------");
            console.log("selectedUser: ", selectedUser);
            console.log("selectedGroup: ", selectedGroup);
            console.log("-------------------------------");
            console.log("");
            console.log("");
        }

        function onGroupSelect(e) {

            if ( e.selectedIndex === 0 ) {
                selectedGroup = 0;
                var preview = document.querySelector('#contact-preview');

                const foundContacts = users;

                var el = document.querySelector('#contact-preview');

                el.innerHTML = '';

                var ul = document.createElement('div');

                ul.className = "list-group";

                let contactList = document.querySelector("#contact-list");
                contactList.innerHTML = '';

                let option = document.createElement('option');
                option.value = -1;
                option.text = "Choose Contact";
                contactList.appendChild( option );

                foundContacts.map( user => {
                    let a = document.createElement('a');
                    a.className = "list-group-item list-group-item-action";
                    a.href = "#";
                    a.setAttribute("data-contact-id", user.account.id);
                    let span = document.createElement('span');
                    span.innerHTML = user.account.id;
                    a.appendChild(span);

                    option = document.createElement('option');
                    option.value = user.account.id;
                    option.text = user.account.name;
                    contactList.appendChild( option );

                    a.onclick = function(e) {
                        e.preventDefault();
                        const contact_id = e.currentTarget.getAttribute("data-contact-id");
                        let contactList = document.querySelector("#contact-list");
                        let options = contactList.options;

                        for(let index=0; index < options.length; index++) {
                            if (options[index].value === contact_id) {
                                contactList.selectedIndex = index;
                                var contactName = document.querySelector('#contact-name');
                                el.innerHTML = '';
                                break;
                            }
                        }

                        var searchContacts = document.getElementById('search-contacts');
                        searchContacts.value = '';
                        showTally();

                    }.bind(this);

                    ul.appendChild(a);
                });

                console.log(foundContacts);
            } else {
                const groupOption = e.options[ e.selectedIndex ];
                selectedGroup = groupOption.value;
                var preview = document.querySelector('#contact-preview');

                const foundContacts = users.filter( user => {
                    return user.group.id === parseInt(groupOption.value);
                });

                var el = document.querySelector('#contact-preview');

                el.innerHTML = '';

                var ul = document.createElement('div');

                ul.className = "list-group";

                let contactList = document.querySelector("#contact-list");
                contactList.innerHTML = '';

                let option = document.createElement('option');
                option.value = -1;
                option.text = "Choose Contact";
                contactList.appendChild( option );

                foundContacts.map( user => {
                    let a = document.createElement('a');
                    a.className = "list-group-item list-group-item-action";
                    a.href = "#";
                    a.setAttribute("data-contact-id", user.account.id);
                    let span = document.createElement('span');
                    span.innerHTML = user.account.id;
                    a.appendChild(span);

                    option = document.createElement('option');
                    option.value = user.account.id;
                    option.text = user.account.name;
                    contactList.appendChild( option );

                    a.onclick = function(e) {
                        e.preventDefault();
                        const contact_id = e.currentTarget.getAttribute("data-contact-id");
                        let contactList = document.querySelector("#contact-list");
                        let options = contactList.options;

                        el.innerHTML = '';

                        for(let index=0; index < options.length; index++) {
                            if (options[index].value === contact_id) {
                                contactList.selectedIndex = index;
                                showTally();
                                return;
                            }
                        }

                        console.log(e);
                    }.bind(this);

                    ul.appendChild(a);
                });

                console.log(groupOption.text);
                console.log(foundContacts);
            }
            showTally();
        }

        function resetGroupSelect() {

            selectedGroup = 0;
            var preview = document.querySelector('#contact-preview');

            const foundContacts = users;

            var el = document.querySelector('#contact-preview');

            el.innerHTML = '';

            var ul = document.createElement('div');

            ul.className = "list-group";

            let contactList = document.querySelector("#contact-list");
            contactList.innerHTML = '';

            let option = document.createElement('option');
            option.value = -1;
            option.text = "Choose Contact";
            contactList.appendChild( option );

            foundContacts.map( user => {
                let a = document.createElement('a');
                a.className = "list-group-item list-group-item-action";
                a.href = "#";
                a.setAttribute("data-contact-id", user.account.id);
                let span = document.createElement('span');
                span.innerHTML = user.account.id;
                a.appendChild(span);

                option = document.createElement('option');
                option.value = user.account.id;
                option.text = user.account.name;
                contactList.appendChild( option );

                a.onclick = function(e) {
                    e.preventDefault();
                    const contact_id = e.currentTarget.getAttribute("data-contact-id");
                    let contactList = document.querySelector("#contact-list");
                    let options = contactList.options;

                    for(let index=0; index < options.length; index++) {
                        if (options[index].value === contact_id) {
                            contactList.selectedIndex = index;
                            var contactName = document.querySelector('#contact-name');
                            el.innerHTML = '';
                            break;
                        }
                    }

                    var searchContacts = document.getElementById('search-contacts');
                    searchContacts.value = '';
                    showTally();

                }.bind(this);

                ul.appendChild(a);
            });

            console.log(foundContacts);
            showTally();
        }

        function onContactSearch(e) {

            let contactList = document.querySelector("#contact-list");

            let foundContacts = [];
            for(let i=0; i < contactList.options.length; i++) {
                let option = contactList.options[i];
                let name = option.text;
                if (name.search(e.value) !== -1) {
                    foundContacts.push({ value: option.value, text: name });
                }
            }

            var el = document.querySelector('#contact-preview');

            el.innerHTML = '';

            var ul = document.createElement('div');

            ul.className = "list-group";

            foundContacts.map( user => {
                let a = document.createElement('a');
                a.className = "list-group-item list-group-item-action";
                a.href = "#";
                a.setAttribute("data-contact-id", user.value);
                let span = document.createElement('span');
                span.innerHTML = user.text;
                a.appendChild(span);
                a.onclick = function(e) {
                    e.preventDefault();
                    const contact_id = e.currentTarget.getAttribute("data-contact-id");
                    let options = contactList.options;
                    selectedUser = contact_id;
                    for(let index=0; index < options.length; index++) {
                        if (options[index].value === contact_id) {
                            contactList.selectedIndex = index;
                            var contactName = document.querySelector('#contact-name');
                            contactName.disabled = false;
                            contactName.value = options[index].text;
                            contactName.disabled = true;
                            el.innerHTML = '';
                            break;
                        }
                    }

                    var searchContacts = document.getElementById('search-contacts');
                    searchContacts.value = '';
                    showTally();
                    console.log(e);
                }.bind(this);

                ul.appendChild(a);
            });

            el.appendChild(ul);
            showTally();
        }

        function resetSelectedContact(e) {
            // debugger;
            var searchContacts = document.getElementById('search-contacts');
            searchContacts.value = '';
            var contactName = document.querySelector('#contact-name');

            contactName.disabled = false;
            contactName.value = '';
            contactName.disabled = true;
            var groupList = document.querySelector('#group-list');
            groupList.selectedIndex = 0;
            resetGroupSelect();
            return false;
        }

        function formatMessage(e) {

            let message = document.querySelector('#message').value;
            let newLinkPanel = document.querySelector('#newLinkPanel');
            document.querySelector('#link-description').focus();
            if (message.search("#link#") !== -1) {
                newLinkPanel.className = 'show';
                document.querySelector('#insert-link-btn').onclick = insertLink;
                document.querySelector('#cancel-insert-btn').onclick = cancelLinkPanel;
            }
            console.log(message);
        }

        let formatters = (function() {
            let $ = {
                fn: (function() {
                    return {
                        link: function (d, l) {
                            return "<a href='"+l+"'>" + d + "</a>";
                        }
                    }
                }())
            };
            return {
                link: $.fn.link
            }
        }());

        function cancelLinkPanel(e) {
            e.preventDefault();
            let newLinkPanel = document.querySelector('#newLinkPanel');
            let description = document.querySelector('#link-description');
            let link = document.querySelector('#link-location');
            description.value = '';
            link.value = '';
            newLinkPanel.className = '';
            return false;
        }

        function insertLink(e) {
            e.preventDefault();
            let newLinkPanel = document.querySelector('#newLinkPanel');
            let description = document.querySelector('#link-description');
            let descriptionValue = description.value;
            let link = document.querySelector('#link-location');
            let linkValue = link.value;
            let messageContainer = document.querySelector('#message');
            let message = messageContainer.value;

            if (message.search("#link#") !== -1) {
                // debugger;
                let formattedLink = formatters.link(descriptionValue, linkValue);
                message = message.replace("#link#", formattedLink);
                messageContainer.value = message;
                description.value = '';
                link.value = '';
                newLinkPanel.className = '';
            }

            console.log(message);
            return false;
        }

        // document.querySelector('#send-btn').onclick = sendMessage;

    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">


                    <form class="form-horizontal" method="POST" action="/contact">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="contact">Search Contacts: </label>
                            <div class="row">
                                <div class="col-md-4">

                                    <select class="form-control" id="group-list" onchange="onGroupSelect(this)">
                                        <option value="-1">Choose Group</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->description }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="search-contacts" placeholder="Search Contacts" onkeyup="onContactSearch(this)" />
                                    <span id="contact-preview"></span>
                                </div>

                                <div class="col-md-4">

                                    <select class="form-control" id="contact-list" onchange="selectContact(this)">
                                        <option value="-1">Choose Contact</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->account->id }}">{{ $user->account->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="contact-name">To: </label>
                                    <input type="text" class="form-control" id="contact-name" name="contact-name" disabled="disabled" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="clear-contact">&nbsp;</label>
                                    <a href="#" id="clear-contact" name="clear-contact" class="form-control btn btn-secondary" onclick="return resetSelectedContact(this)">Reset Selected Contact</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="subject">Subject: </label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>

                        <div class="form-group" style="position: relative">
                            <label for="message">Message: </label>
                            <textarea class="form-control luna-message" id="message" placeholder="Type your messages here" name="message" rows="10" required onkeyup="formatMessage(this)"></textarea>

                            <div class="form-group">
                                <a href="#" name="send-btn" id="send-btn" class="btn btn-primary my-10" onclick="return sendMessage(this)">Send Message</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <style>

        .pagination { justify-content: center!important; }

        .group {
            display: block;
        }
        .group.hide {
            display: none;
        }

        .new-group-window {
            display: none;
        }
        .new-group-window.show {
            display:block;
        }
        .center-text {
            text-align: center;
        }
    </style>
@stop
