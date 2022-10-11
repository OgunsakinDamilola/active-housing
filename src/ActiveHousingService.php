<?php


namespace Ogunsakindamilola\ActiveHousing;


class ActiveHousingService
{
    public function getUser($id, $resource = null)
    {
        if (is_null($resource)) $resource = '/users/' . $id;
        return $this->handleResponse($resource);
    }

    public function getPaginatedUsers($page, $resource = null)
    {
        if (is_null($resource)) $resource = '/users?page=' . $page;
        return $this->handleResponse($resource);
    }

    private function handleResponse($resource)
    {
        return (new ReqResClient($resource))->handle();
    }
}
