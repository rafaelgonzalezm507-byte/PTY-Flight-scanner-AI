#!/bin/bash
echo "🚀 Iniciando Sincronización Global de Precios..."

# --- ESTADOS UNIDOS ---
python3 agente_inteligente.py MIA
python3 agente_inteligente.py JFK
python3 agente_inteligente.py LAX
python3 agente_inteligente.py MCO
python3 agente_inteligente.py ORD

# --- EUROPA (ITALIA Y OTROS) ---
python3 agente_inteligente.py MAD
python3 agente_inteligente.py BCN
python3 agente_inteligente.py FCO
python3 agente_inteligente.py MXP
python3 agente_inteligente.py VCE
python3 agente_inteligente.py CDG
python3 agente_inteligente.py LHR

# --- LATINOAMÉRICA ---
python3 agente_inteligente.py BOG
python3 agente_inteligente.py MEX
python3 agente_inteligente.py SCL
python3 agente_inteligente.py EZE
python3 agente_inteligente.py LIM
python3 agente_inteligente.py PTY

echo "✅ Base de datos sincronizada con los principales Hubs globales."
