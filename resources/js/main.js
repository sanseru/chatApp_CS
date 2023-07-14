import { Tabs } from "flowbite";

/*
 * tabElements: array of tab objects
 * options: optional
 */
const options = {
    onShow: (tab) => {
        var inputElement = document.getElementById("activeTabsInput");
        // Set the value of the input element
        inputElement.value = tab._activeTab.id;
    },
};

const tabElements = [
    {
        id: "profile",
        triggerEl: document.querySelector("#profile-tab"),
        targetEl: document.querySelector("#profile"),
    },
    {
        id: "dashboard",
        triggerEl: document.querySelector("#dashboard-tab"),
        targetEl: document.querySelector("#dashboard"),
    },
    {
        id: "settings",
        triggerEl: document.querySelector("#settings-tab"),
        targetEl: document.querySelector("#settings"),
    },
];
const tabs = new Tabs(tabElements, options);

// console.log(tabs.getActiveTab());

var li = $("#chatContainer li");
var liSelected;
var container = $("#chatContainer");
$(document).on("click", "#chatContainer li", function () {
    var liS = $(".selected");

    var name = $(this).attr("data-name");
    var listSubjectActive = $("#listSubjectActive");
    if ($(this).hasClass("selected")) {
        liS.removeClass("selected");
        $(this).removeClass("selected");
        listSubjectActive.text("");
        liSelected = null;
    } else {
        li.removeClass("selected");
        liS.removeClass("selected");
        $(this).addClass("selected");
        liSelected = $(this);
        listSubjectActive.text(name);
        scrollToSelected();
        
    }
});

$(document).on("keydown", function (e) {
    var li = $("#chatContainer li");
    // var liSelected = $(".selected");
    if (e.which === 40) {
        if (liSelected) {
            liSelected.removeClass("selected");
            var next = liSelected.next("li");
            if (next.length > 0) {
                liSelected = next.addClass("selected");
            } else {
                liSelected = li.eq(0).addClass("selected");
            }
        } else {
            liSelected = li.eq(0).addClass("selected");
        }
        scrollToSelected();
    } else if (e.which === 38) {
        if (liSelected) {
            liSelected.removeClass("selected");
            var prev = liSelected.prev("li");
            if (prev.length > 0) {
                liSelected = prev.addClass("selected");
            } else {
                liSelected = li.last().addClass("selected");
            }
        } else {
            liSelected = li.last().addClass("selected");
        }
        scrollToSelected();
    }
    if (liSelected) {
        var selectedValue = liSelected.text();
        var selectedDataId = liSelected.attr("data-id");
        var name = liSelected.attr("data-name");
        var listSubjectActive = $("#listSubjectActive");

        listSubjectActive.text(name);
        console.log(selectedDataId);
    }
});

function scrollToSelected() {
    console.log(liSelected);
    if (liSelected) {
        var selectedId = liSelected.attr("id");
        var selectedElement = document.getElementById(selectedId);

        if (selectedElement) {
            // selectedElement.scrollIntoView({ behavior: "smooth", block: "center" });
            selectedElement.scrollIntoView({
                behavior: "smooth",
                block: "center",
                inline: "nearest",
            });
        }
    }
}

// Burger Option

const burgerButton = document.getElementById("burger-button");
const optionsBurger = document.getElementById("options");

window.myEditors = null; // Declare the global variable

burgerButton.addEventListener("click", () => {
    optionsBurger.classList.toggle("hidden");
});

ClassicEditor.create(document.querySelector("#chatMessagetextRight"), {
    extraPlugins: [MentionCustomization], // Add the custom mention plugin function.
    width: "100%",
    placeholder: "Message...", // Set the placeholder text
    toolbar: {
        items: [
            "link",
            // More toolbar items.
            // ...
        ],
    },
    toolbarSize: "10px", // Set the toolbar size to small
    link: {
        // Automatically add target="_blank" and rel="noopener noreferrer" to all external links.
        addTargetToExternalLinks: true,

        // Let the users control the "download" attribute of each link.
        decorators: [
            {
                mode: "manual",
                label: "Downloadable",
                attributes: {
                    download: "download",
                },
            },
        ],
    },
    mention: {
        feeds: [
            {
                marker: "@",
                feed: getFeedItems,
                itemRenderer: customItemRenderer,
            },
            {
                marker: "#",
                feed: getFeedItems,
                itemRenderer: customItemRenderer,
            },
        ],
    },
})
    .then((editor) => {
        console.log("Editor was initialized", editor);
        // myEditor = editor;
        window.myEditors = editor; // Assign the editor to the global variable
    })
    .catch((error) => {
        console.error(error);
    });

function MentionCustomization(editor) {
    // The upcast converter will convert <a class="mention" href="" data-user-id="">
    // elements to the model 'mention' attribute.
    editor.conversion.for("upcast").elementToAttribute({
        view: {
            name: "a",
            key: "data-mention",
            classes: "mention",
            attributes: {
                href: true,
                "data-user-id": true,
            },
        },
        model: {
            key: "mention",
            value: (viewItem) => {
                // The mention feature expects that the mention attribute value
                // in the model is a plain object with a set of additional attributes.
                // In order to create a proper object, use the toMentionAttribute helper method:
                const mentionAttribute = editor.plugins
                    .get("Mention")
                    .toMentionAttribute(viewItem, {
                        // Add any other properties that you need.
                        link: viewItem.getAttribute("href"),
                        userId: viewItem.getAttribute("data-user-id"),
                    });

                return mentionAttribute;
            },
        },
        converterPriority: "high",
    });

    // Downcast the model 'mention' text attribute to a view <a> element.
    editor.conversion.for("downcast").attributeToElement({
        model: "mention",
        view: (modelAttributeValue, { writer }) => {
            // Do not convert empty attributes (lack of value means no mention).
            if (!modelAttributeValue) {
                return;
            }

            return writer.createAttributeElement(
                "a",
                {
                    class: "mention",
                    "data-mention": modelAttributeValue.id,
                    "data-user-id": modelAttributeValue.userId,
                    // 'href': modelAttributeValue.link
                    onclick: 'mainChange('+modelAttributeValue.userId+')',
                },
                {
                    renderUnsafeAttributes: ["onclick"],
                    // Make mention attribute to be wrapped by other attribute elements.
                    priority: 20,
                    // Prevent merging mentions together.
                    id: modelAttributeValue.uid,
                }
            );
        },
        converterPriority: "high",
    });
}

const items = [
    {
        id: "@swarley",
        userId: "1",
        name: "Barney Stinson",
        link: "https://www.imdb.com/title/tt0460649/characters/nm0000439",
    },
    {
        id: "@lilypad",
        userId: "2",
        name: "Lily Aldrin",
        link: "https://www.imdb.com/title/tt0460649/characters/nm0004989",
    },
    {
        id: "@marry",
        userId: "3",
        name: "Marry Ann Lewis",
        link: "https://www.imdb.com/title/tt0460649/characters/nm1130627",
    },
    {
        id: "@marshmallow",
        userId: "4",
        name: "Marshall Eriksen",
        link: "https://www.imdb.com/title/tt0460649/characters/nm0781981",
    },
    {
        id: "@rsparkles",
        userId: "5",
        name: "Robin Scherbatsky",
        link: "https://www.imdb.com/title/tt0460649/characters/nm1130627",
    },
    {
        id: "@tdog",
        userId: "6",
        name: "Ted Mosby",
        link: "https://www.imdb.com/title/tt0460649/characters/nm1102140",
    },
];

function getFeedItems(queryText) {
    // As an example of an asynchronous action, return a promise
    // that resolves after a 100ms timeout.
    // This can be a server request or any sort of delayed action.
    return new Promise((resolve) => {
        setTimeout(() => {
            const itemsToDisplay = items
                // Filter out the full list of all items to only those matching the query text.
                .filter(isItemMatching)
                // Return 10 items max - needed for generic queries when the list may contain hundreds of elements.
                .slice(0, 10);

            resolve(itemsToDisplay);
        }, 100);
    });

    // Filtering function - it uses `name` and `username` properties of an item to find a match.
    function isItemMatching(item) {
        // Make the search case-insensitive.
        const searchString = queryText.toLowerCase();

        // Include an item in the search results if name or username includes the current user input.
        return (
            item.name.toLowerCase().includes(searchString) ||
            item.id.toLowerCase().includes(searchString)
        );
    }
}

function customItemRenderer(item) {
    const itemElement = document.createElement("span");

    itemElement.classList.add("custom-item");
    itemElement.id = `mention-list-item-id-${item.userId}`;
    itemElement.textContent = `${item.name} `;

    const usernameElement = document.createElement("span");

    usernameElement.classList.add("custom-item-username");
    usernameElement.textContent = item.id;
    itemElement.appendChild(usernameElement);

    return itemElement;
}
