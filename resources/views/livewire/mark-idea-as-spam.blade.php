<x-modal-confirm
    event-to-open-modal="custom-show-mark-idea-as-spam-modal"
    event-to-close-modal="ideaWasMarkedAsSpam"
    modal-title="Mark as Spam"
    modal-description="Are you sure this is actual spam?"
    modal-confirm-button-text="Mark As Spam"
    wire-click="markAsSpam"
/>
