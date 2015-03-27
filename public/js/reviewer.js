/**
 * Checks if a is vertically overlapping b. 
 * Returns the amount of pixels a must move 
 * down to get away from b if b moves the same 
 * number of pixels upwards.
 * @param a the A object
 * @param b the B object
 * @return see description, and 0 if the objects don't overlap
 */
function isObjOnObj(a, b) {
    // Get some interesting values
    var at = a.offsetTop;
    var ab = a.offsetTop + a.offsetHeight;
    var bt = b.offsetTop;
    var bb = b.offsetTop + b.offsetHeight;

    if (bt>at && ab>bt && bb>ab) { return - (ab - bt) / 2; }
    if (at>bt && bb>at && ab>bb) { return + (bb - at) / 2; }
    if (at>bt && bb>ab)          { return at - bt > bb - ab ? (bb - at) / 2 : - (ab - bt) / 2; }
    if (bt>at && ab>bb)          { return bt - at > ab - bb ? (ab - bt) / 2 : - (bb - at) / 2; }

    return 0;
}

/**
 * Takes all objects with given selector and makes sure 
 * the does not overlap. If they do, they will be moved.
 * @param selector the jQuery selector to check for
 */
function rearrange(selector) {
    // Ok is our invariant, if ok = true, we know nothing overlaps
    var ok = false;
    while (!ok) {
        var okInternal = true;

        // Double loop through and move objects if they are on each other
        $(selector).each(function(i) {
            var obj1 = document.getElementById($(this).prop('id'));
            $(selector).each(function(j) {
                var obj2 = document.getElementById($(this).prop('id'));
                var diff = isObjOnObj(obj1, obj2);
                if (diff != 0) {
                    obj1.style.top = (parseInt(obj1.style.top.substring(0, obj1.style.top.length - 2)) + diff) + 'px';
                    obj2.style.top = (parseInt(obj2.style.top.substring(0, obj2.style.top.length - 2)) - diff) + 'px';
                    okInternal = false;
                }
            });
        });
        ok = okInternal;
    }

    return;
}

/**
 * Aligns the object in the same height as the alignment object and to the right of it (+10px).
 * @param element the element to align
 * @param alignment the element to align after
 */
function align(element, alignment) {
    element.style.top = alignment.offsetTop + 'px';
    element.style.left = (alignment.offsetLeft + alignment.offsetWidth + 10) + 'px';

    return;
}

/**
 * Function that expands range to the nearest parent.
 */
Selection.prototype.coverAll = function() {
    var ranges = [];
    for (var i = 0; i < this.rangeCount; i++) {
        var range = this.getRangeAt(i);
        while (range.startContainer.nodeType == 3 || range.startContainer.childNodes.length == 1)
            range.setStartBefore(range.startContainer);
        while (range.endContainer.nodeType == 3 || range.endContainer.childNodes.length == 1)
            range.setEndAfter(range.endContainer);
        ranges.push(range);
    }
    // Deletes all ranges to make _one_ new
    this.removeAllRanges();
    for (var i = 0; i < ranges.length; i++) {
        this.addRange(ranges[i]);
    }

    return;
};

/**
 * Creates a new comment on the page.
 * @param userName the name of the user to display on comment
 */
Selection.prototype.commentize = function(userName) {
    // We should leave if we're trying to comment on the wrong part of the page
    if (!elementContainsSelection(document.getElementById('pmc-text')))
        return;

    // The id of the new comment TODO Fix
    var thisId = Math.floor((Math.random() * 10000) + 1);
    this.coverAll();

    // Wrap correct parts with <span class="comment" id=""></span>
    var range = this.getRangeAt(0);
    var parent = range.commonAncestorContainer;
    var b = document.createElement('span');
    b.id = thisId;
    b.className = 'comment';
    if (parent.nodeType == 3) { // 3 är Text
        range.surroundContents(b);
    } else {
        var content = range.extractContents();
        b.appendChild(content);
        range.insertNode(b);
    }

    // Now place a placeholder in the beginning of the range, 
    // so we now where we are when placing comments
    var placeHolder = document.createElement('span');
    placeHolder.className = 'placeholder';
    range.insertNode(placeHolder);

    // Adds the box
    addCommentBox(thisId, userName, placeHolder);
    
    // Make sure it doesn't overlap
    rearrange('.comment-outer');

    // To make sure everything shows, set the timer!
    setTimeout(function () {
        $('#' + thisId).addClass('active');
        $('#comment' + thisId).removeClass('inactive');
        $('#comment' + thisId + ' button').show();
    }, 10);

    return;
};

/**
 * Creates and adds a comment box with given id
 */
function addCommentBox(thisId, userName, placeHolder, content, focus) {
    content = typeof content !== 'undefined' ? content : '';
    focus = typeof focus !== 'undefined' ? focus : true;

    // The small image to the right (pratbubbla)
    var image = document.createElement('img');
    image.src = '/images/arrowcorner.png';

    // Create buttons and text field
    var button1 = document.createElement('button');
    button1.innerHTML = 'Spara';
    button1.onclick = function() {
        save(thisId);
    }
    var button2 = document.createElement('button');
    button2.innerHTML = 'Ta bort';
    button2.className = 'delete';
    var textField = document.createElement('input');
    textField.type = 'text';
    textField.id = 'val' + thisId;
    textField.value = content;
    textField.className = 'text';
    var hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.value = content + ' ';
    hiddenField.className = 's';

    // Create the inner box and append its children
    var commentBox = document.createElement('div');
    commentBox.innerHTML = '<span>' + userName + '</span>';
    commentBox.className = 'comment-box';
    commentBox.appendChild(textField);
    commentBox.appendChild(hiddenField);
    commentBox.appendChild(button2);
    commentBox.appendChild(button1);

    // Create the outer box and append children
    var commentOuter = document.createElement('div');
    commentOuter.id = 'comment' + thisId;
    commentOuter.className = 'comment-outer inactive';
    commentOuter.appendChild(image);
    commentOuter.appendChild(commentBox);

    // Place it correctly
    align(commentOuter, placeHolder);

    // And display it on the page by appending it
    document.getElementById('pm-comments').appendChild(commentOuter);

    // Remove selection so it doesn't disturb
    removeSelection();

    // And move focus to text field
    if (focus)
        textField.focus();

    // Hide buttons from start
    $('.comment-outer button').hide();

    return;
}

/**
 * Removes a text selection.
 */
function removeSelection() {
    if (window.getSelection) {  
        // All browsers, except IE before version 9
        var selection = window.getSelection();                                        
        selection.removeAllRanges();
    } else if (document.selection.createRange) {        
        // Internet Explorer
        var range = document.selection.createRange();
        document.selection.empty();
    }

    return;
}

/**
 * Checks wether a node is in or is the container or not.
 * @return true if node is in container, false otherwise.
 */
function isOrContains(node, container) {
    while (node) {
        if (node === container)
            return true;
        node = node.parentNode;
    }
    return false;
}

/**
 * Checks wether an element contains the actual selection.
 * @param el the element to check if contained in selection
 * @return true if selection is in element, false otherwise.
 */
function elementContainsSelection(el) {
    var sel;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.rangeCount > 0) {
            for (var i = 0; i < sel.rangeCount; ++i) {
                if (!isOrContains(sel.getRangeAt(i).commonAncestorContainer, el)) {
                    return false;
                }
            }
            return true;
        }
    } else if ((sel = document.selection) && sel.type != "Control") {
        return isOrContains(sel.createRange().parentElement(), el);
    }
    return false;
}

/**
 * Returns true if element obj has the class className
 * @param obj the element to check
 * @param className the class to check for
 * @return true if obj has className as class, false otherwise.
 */
function hasClass(obj, className) {
    var classes = obj.prop('class').split(' ');
    var found = false;
    for (var i = 0; i < classes.length && !found; i++) {
        if (classes[i] == className) {
            found = true;
        }
    }
    return found;
}


/**
 * Checks if a comment container was clicked.
 * @param event the click event
 * @return true if a span.comment was clicked, 
 *       or one of its children was clicked, false otherwise
 */
function inlineCommentClicked(event) {
    var obj = $(event.target);
    var parent = obj.closest('.comment-outer');
    if (parent.length != 1)
        return -1;
    
    return parent.prop('id').substring(7);
}

/**
 * Checks if an inline comment span was clicked.
 * @param event the click event
 * @return true if a .comment-outer was clicked, 
 *       or one of its children was clicked, false otherwise
 */
function commentBoxClicked(event) {
    var obj = $(event.target);
    var parent = obj.parent().closest('span');
    if (parent.length != 1)
        return -1;
    
    if (!hasClass(parent, 'comment'))
        return -1;
    
    return parent.prop('id');
}

/**
 * Checks if a comment, either inline or the box, was clicked.
 * @param event the click event to analyse
 * @return the id of the comment if the comment was clicked, -1 otherwise
 */
function commentClicked(event) {
    // Test if inline comment was clicked
    var id = inlineCommentClicked(event);
    if (id != -1)
        return id;

    // If not, test if comment box was clicked
    id = commentBoxClicked(event);
    if (id != -1)
        return id;

    // Else, return "not found code" -1
    return -1;
}