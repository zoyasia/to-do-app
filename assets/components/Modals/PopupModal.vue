<template>
    <transition name="fade">
        <div>
            <div class="popup-modal modal-dialog">
                <div class="modal-content">
                    <header class="modal-header" id="modalTitle">
                        <slot name="header" class="modal-title"></slot>
                        <button type="button" class="btn-close" @click="close" aria-label="Close Modal"></button>
                    </header>
                    <slot name="body" class="modal-body"></slot>
                    <footer class="modal-footer">
                        <slot name="footer"></slot>
                    </footer>
                </div>
            </div>
        </div>
    </transition>
</template>

<script lang="ts">

export default {
    name: 'PopupModal',

    data: () => ({
        isVisible: false,
    }),

    methods: {
        close() {
            this.$emit('close');
        },
    },
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.popup-modal {
    background-color: rgba(0, 0, 0, 0.9);
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20rem;
    display: flex;
    align-items: center;
    z-index: 1;
}
</style>