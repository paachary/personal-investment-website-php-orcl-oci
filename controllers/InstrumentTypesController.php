<?php

class InstrumentTypesController
{

  protected $db;

  public function __construct()
  {
    $config = require basePath('config/_db.php');
    $this->db = new Database($config);
  }

  public function getInstrumentTypes()
  {
    return $this->db->getInstrumentTypes();
  }


  public function index()
  {
    $instrumentTypeListings = $this->getInstrumentTypes();

    loadView('listings/instrumentTypes/listing', [
      'instrumentTypeListings' => $instrumentTypeListings
    ]);
  }

  public function edit($params)
  {
    $instrumentTypeId = $params['instrumentTypeId'] ?? '';

    $instrumentTypeListings = $this->db->getInstrumentType($instrumentTypeId);

    loadView('listings/instrumentTypes/edit', [
      'instrumentTypeListings' => $instrumentTypeListings
    ]);
  }

  public function create($params)
  {
    loadView('listings/instrumentTypes/create');
  }

  public function update()
  {

    $allowedFields = ['_instrumentTypeId', 'desc',];

    $newInstrumentTypeFields = array_intersect_key($_POST, array_flip($allowedFields));

    $newInstrumentTypeFields = array_map('sanitize', $newInstrumentTypeFields);


    $this->db->updateInstrumentType(
      intval($newInstrumentTypeFields["_instrumentTypeId"]),
      strtoupper($newInstrumentTypeFields["desc"])
    );

    Session::setFlashMessage('success_message', 'Record Updated Successfully!');

    redirect("/instrumentTypes");
  }

  public function store()
  {
    $allowedFields = [
      'instrumentType',
      'instrumentTypeDesc'
    ];

    $newInstrumentTypeFields = array_intersect_key($_POST, array_flip($allowedFields));

    $newInstrumentTypeFields = array_map('sanitize', $newInstrumentTypeFields);

    $status = $this->db->insertInsrumentType(
      instrumentType: strtoupper($newInstrumentTypeFields['instrumentType']),
      instrumentTypeDesc: strtoupper($newInstrumentTypeFields['instrumentTypeDesc'])
    );

    if ($status === 0) {
      Session::setFlashMessage('success_message', 'Record Created Successfully!');
    } elseif ($status === 1) {
      Session::setFlashMessage('error_message', 'Record already exists!');
    }
    redirect("/instrumentTypes");
  }
}
