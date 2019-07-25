<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Usuario;
use App\Entity\Cliente;
use App\Entity\Direccion;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->cascada($manager);
        $this->individual($manager);
        $this->soloUsuario($manager);
    }
    
    private function cascada(ObjectManager $manager) {
        $usuario = new Usuario();      
        $usuario->setCorreo('juan@123.cl')
                ->setContrasena('1234')
        ;
        
        $direccion = new Direccion();
        $direccion->setDireccion("Alameda")
                ->setNumero('123 of A')
                ->setComuna('Santiago')
        ;
                
        $cliente = new Cliente();
        $cliente->setNombre('Juan Palotes')
                ->setRut(12345678)
                ->setDv('5')
                ->setTelefono('988948765')
                ->setUsuario($usuario)   
                ->addDireccion($direccion)
        ;
        
        
        $manager->persist($cliente);
        $manager->flush();
    }
    
    private function individual(ObjectManager $manager) {
        $usuario = new Usuario();      
        $usuario->setCorreo('macarena@123.cl')
                ->setContrasena('9087')
        ;
        
        $manager->persist($usuario);
        $manager->flush();
                        
        $cliente = new Cliente();
        $cliente->setNombre('Macarena Cortes')
                ->setRut(12345678)
                ->setDv('5')
                ->setTelefono('988999765')
                ->setUsuario($usuario)                   
        ;
        
        $manager->persist($cliente);
        $manager->flush();
        
        $direccion = new Direccion();
        $direccion->setDireccion("San Pablo")
                ->setNumero('4356')
                ->setComuna('Lo Prado')
                ->setCliente($cliente)
        ;
        
        $cliente->addDireccion($direccion);
        
        $manager->persist($direccion);
        $manager->flush();
        
        
        
    }
    
    private function soloUsuario(ObjectManager $manager) {
        $usuario = new Usuario();      
        $usuario->setCorreo('roberto@123.cl')
                ->setContrasena('4321')
        ;
        
        $manager->persist($usuario);
        $manager->flush();
    }
}
