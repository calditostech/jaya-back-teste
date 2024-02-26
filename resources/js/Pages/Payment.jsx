import React, { useState, useEffect } from 'react';
import MercadoPago from 'mercadopago/sdk-react';

const Payment = () => {
  const [installments, setInstallments] = useState([]);
  const [selectedInstallment, setSelectedInstallment] = useState('');
  const [cardToken, setCardToken] = useState('');
  const [paymentMethodId, setPaymentMethodId] = useState('');
  const [transactionAmount, setTransactionAmount] = useState(0);
  const [email, setEmail] = useState('');
  const [cpf, setCpf] = useState('');

  useEffect(() => {
    MercadoPago.setPublishableKey('sua_chave_publica_do_mercado_pago');

    const getInstallmentsData = async () => {
      try {
        const installmentsData = await MercadoPago.getInstallments({
          bin: '123456', // BIN do cartão
          amount: transactionAmount,
        });
        setInstallments(installmentsData[0]?.payer_costs || []);
      } catch (error) {
        console.error('Erro ao obter opções de parcelamento:', error);
      }
    };

    getInstallmentsData();
  }, [transactionAmount]);

  const handleInstallmentChange = (event) => {
    setSelectedInstallment(event.target.value);
  };

  const handleCardTokenCreation = async () => {
    try {
      const cardTokenResponse = await MercadoPago.createCardToken({
        cardNumber: '4509953566233704', 
        cardholderName: 'JOHN DOE', 
        cardExpirationMonth: '12', 
        cardExpirationYear: '2023', 
        securityCode: '123', 
      });

      setCardToken(cardTokenResponse.id);
    } catch (error) {
      console.error('Erro ao criar token do cartão:', error);
    }
  };

  const handlePayment = async () => {
    const payload = {
      transaction_amount: transactionAmount,
      installments: parseInt(selectedInstallment, 10),
      token: cardToken,
      payment_method_id: paymentMethodId,
      payer: {
        email,
        identification: {
          type: 'CPF',
          number: cpf,
        },
      },
    };

    console.log('Payload para o backend:', payload);
  };

  return (
    <div>
      <h1>Tela de Criação de Pagamento</h1>
      <label>
        Valor da Transação:
        <input
          type="number"
          value={transactionAmount}
          onChange={(e) => setTransactionAmount(e.target.value)}
        />
      </label>
      <br />
      <label>
        Email do Pagador:
        <input
          type="text"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
        />
      </label>
      <br />
      <label>
        CPF do Pagador:
        <input
          type="text"
          value={cpf}
          onChange={(e) => setCpf(e.target.value)}
        />
      </label>
      <br />
      <label>
        Parcelamento:
        <select value={selectedInstallment} onChange={handleInstallmentChange}>
          {installments.map((installment) => (
            <option key={installment.installments} value={installment.installments}>
              {installment.recommended_message}
            </option>
          ))}
        </select>
      </label>
      <br />
      <button onClick={handleCardTokenCreation}>Criar Token do Cartão</button>
      <br />
      <button onClick={handlePayment}>Realizar Pagamento</button>
    </div>
  );
};

export default Payment;

