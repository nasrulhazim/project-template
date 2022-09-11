<?php

namespace App\Concerns\Datatable;

trait InteractsWithDestroy
{
    public function destroyConfirmation()
    {
        $this->emitTo('confirm', 'displayConfirmation', 'Delete Record', 'Are you sure?', $this->getName(), 'destroyRecord', $this->getSelected());
    }

    public function destroy(array $uuids)
    {
        $this->getModel()::whereIn('uuid', $uuids)->delete();

        $this->clearSelected();

        $this->emit('refreshDatatable');

        $this->emitTo('alert', 'displayAlert',  __('Records'), __('Records succesfully deleted'));
    }
}
